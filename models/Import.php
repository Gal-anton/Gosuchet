<?php


namespace app\models;

use app\models\tables\Okato;
use app\models\tables\Okopf;
use app\models\tables\Oktmo;
use app\models\tables\Okved;
use app\models\tables\Organisation;
use app\models\tables\TipOrganisation;
use app\models\tables\VidOrganisation;
use app\models\tables\VidSob;
use Yii;
use ZipArchive;

class Import
{
    /**
     * @var FtpConnection
     */
    private $_ftp;

    /**
     * @var ZipArchive
     */
    private $_zip;

    /**
     * @var Organisation
     */
    private $_organisation;

    /**
     * @var integer
     */
    private $_importErrors;

    function __construct()
    {
        $this->_ftp = new FtpConnection();
        $this->_zip = new ZipArchive;
    }

    function start()
    {
        $start = microtime(true);
        $directories = $this->_ftp->getFileNames();
        $amountOfFiles = 0;
        //$count = 0;
        foreach ($directories as $directory) {
            $archiveNames = $this->_ftp->getFileNames($directory);
            $log = date('Y-m-d H:i:s') . ' Начата загрузка директории:' . $directory;
            file_put_contents(Yii::getAlias('@runtime') . "/logs/import.log", $log . PHP_EOL, FILE_APPEND);
            foreach ($archiveNames as $archiveName) {
                $log = date('Y-m-d H:i:s') . ' Начата загрузка файла:' . $archiveName;
                file_put_contents(Yii::getAlias('@runtime') . "/logs/import.log", $log . PHP_EOL, FILE_APPEND);
                $directory = $this->getFilesFromArchive($archiveName);
                $listOfFiles = $this->scanDirFullPath($directory);
                $this->exploreFiles($listOfFiles);
                rmdir(substr($directory, 0, -1));
                $amountOfFiles++;
            }
            $log = date('Y-m-d H:i:s') . ' Окончена обработка директории:' . $directory;
            file_put_contents(Yii::getAlias('@runtime') . "/logs/import.log", $log . PHP_EOL, FILE_APPEND);
        }
        $finish = microtime(true);
        print_r("\nThe count of errors = " . $this->_importErrors);
        print_r("\nThe amount of files = " . $amountOfFiles);
        $result = $finish - $start;
        print_r("\nThe time = " . $result . "сек");

    }

    private function unzipFiles($archive, $localDir) {
        if ($this->_zip->open($archive) === TRUE) {
            // путь к каталогу, в который будут помещены файлы
            $this->_zip->extractTo($localDir);
            $this->_zip->close();
            return true;
        }
        return false;
    }

    private function getExtension($fileName) {
        return substr(strrchr($fileName, '.'), 1);
    }

    private function getFilesFromArchive($archiveName) {
        $path = explode("/", $archiveName);
        $localFile = $this->_ftp->getFile($archiveName, array_pop($path));
        $directory = substr($localFile, 0, strlen($localFile) - 4);
        $this->unzipFiles($localFile, $directory);
        unlink($localFile);

        return $directory . "/";
    }

    private function scanDirFullPath($directory)
    {
        $listOfFiles = array();
        foreach (array_diff(scandir($directory), array('..', '.')) as $path) {
            $listOfFiles[] = $directory . $path;
        }
        return $listOfFiles;
    }

    private function exploreFiles($list) {
        foreach ($list as $file) {
            if ($this->getExtension($file) === "xml") {
                $xml = simplexml_load_file($file);
                $this->saveOrganisationFromXML($xml);
            }
            unlink($file);
            unset($this->_organisation);
        }
    }

    private function saveOrganisationFromXML($xml)
    {

        $this->_organisation = new Organisation();

        $ns2 = $xml->getNamespaces(true);
        $body = $xml->children($ns2['ns2'])->body;
        $position = $body->position->children($ns2['']);
        $main = $position->main;
        $other = $position->other;
        $initiator = $position->initiator;
        $classifier = $main->classifier->children('');
        $additional = $position->additional->children('');

        if (isset($initiator->inn)) $this->_organisation->inn = (string)$initiator->inn;
        if (isset($initiator->regNum)) $this->_organisation->reg_num = (string)$initiator->regNum;

        if ($this->_organisation->validate(["inn", "reg_num"])) {
            if (isset($classifier->okopf)) $this->setOkopf($classifier->okopf);
            if (isset($main)) $this->setTipOrganisation($main);
            if (isset($classifier->okved)) $this->setOkved($classifier->okved);

            if (isset($classifier->okved)) {
                $this->setOkved($classifier->okved);
            } elseif (isset($additional->activity->okved)) {
                $this->setOkved($additional->activity->okved);
            }

            if (isset($classifier->oktmo)) {
                $this->setOktmo($classifier->oktmo);
            } elseif (isset($additional->ppo->oktmo)) {
                $this->setOktmo($additional->ppo->oktmo);
            }

            if (isset($additional->okato)) {
                $this->setOkato($additional->okato);
            } elseif (isset($additional->ppo->okato)) {
                $this->setOkato($additional->ppo->okato);
            }

            if (isset($classifier->okfs)) $this->setVidSob($classifier->okfs);
            if (isset($additional->institutionType)) $this->setVidOrganisation($additional->institutionType);
            if (isset($initiator->fullName)) $this->_organisation->full_name = (string)$initiator->fullName;
            if (isset($main->shortName)) $this->_organisation->short_name = (string)$main->shortName;
            if (isset($other->founder->fullName)) $this->_organisation->id_owner = (string)$other->founder->fullName;
            if (isset($additional->ppo->name)) $this->_organisation->ppo = (string)$additional->ppo->name;

            if (!$this->_organisation->save()) {
                $this->_importErrors++;
            }
            $errors = $this->_organisation->getErrors();
            if (!empty($errors)) {
                $log = date('Y-m-d H:i:s') . ' Ошибки:' . print_r($errors, true);
                file_put_contents(Yii::getAlias('@runtime') . "/logs/import.log", $log . PHP_EOL, FILE_APPEND);
            }
            return true;
        }
        return false;
    }

    private function setOkopf($attributes)
    {
        $okopf = Okopf::find()->where(["kod_okopf" => (string)$attributes->code])->asArray()->one();
        if (empty($okopf) === true) {
            $okopf = new Okopf();
            $okopf->kod_okopf = (string)$attributes->code;
            $okopf->name_okopf = (string)$attributes->name;
            if (!$okopf->save()) {
                $this->_importErrors++;
            }
            $this->_organisation->id_okopf = $okopf->getPrimaryKey();
            return;
        }
        $this->_organisation->id_okopf = $okopf["id_okopf"];
    }

    private function setTipOrganisation($attributes) {
        $tip = TipOrganisation::find()->where(["kod_tip" => (string)$attributes->code])->asArray()->one();
        if (is_null($tip)) {
            $tip = new TipOrganisation();
            $tip->kod_tip = (string)$attributes->orgType;
            switch ($tip->kod_tip) {
                case "03":
                    $tip->name_tip = "Бюджетное учреждение";
                    break;
                case "08":
                    $tip->name_tip = "Казеное учреждение";
                    break;
                case "10":
                    $tip->name_tip = "Автономное учреждение";
            }
            if (!$tip->save()) {
                var_dump($tip->errors);
            }
            $this->_organisation->id_tip = $tip->getPrimaryKey();
            return;
        }
        $this->_organisation->id_tip = $tip["id_tip"];
    }

    private function setOkved($attributes)
    {
        $okved = Okved::find()->where(["kod_okved" => (string)$attributes->code])->asArray()->one();
        if (empty($okved) === true) {
            $okved = new Okved();
            $okved->kod_okved = (string)$attributes->code;
            $okved->name_okved = (string)$attributes->name;
            if (!$okved->save()) {
                $this->_importErrors++;
            }
            $this->_organisation->id_okved = $okved->getPrimaryKey();
            return;
        }
        $this->_organisation->id_okved = $okved["id_okved"];
    }

    private function setVidSob($attributes)
    {
        $okfs = VidSob::find()->where(["kod_okfs" => (string)$attributes->code])->asArray()->one();
        if (empty($okfs) === true) {
            $okfs = new VidSob();
            $okfs->kod_okfs = (string)$attributes->code;
            $okfs->name_okfs = (string)$attributes->name;
            if (!$okfs->save()) {
                $this->_importErrors++;
            }
            $this->_organisation->id_okfs = $okfs->getPrimaryKey();
            $this->_organisation->id_buj = (int)$attributes->code;
            return;
        }
        $this->_organisation->id_okfs = $okfs["id_okfs"];
        $this->_organisation->id_buj = (int)$attributes->code;
        unset($okfs);
    }

    private function setOkato($attributes)
    {
        $okato = Okato::find()->where(["kod_okato" => (string)$attributes->code])->asArray()->one();
        if (empty($okato) === true) {
            $okato = new Okato();
            $okato->kod_okato = (string)$attributes->code;
            $okato->name_okato = (string)$attributes->name;
            if (!$okato->save()) {
                $this->_importErrors++;
            }
            $this->_organisation->id_okato = $okato->getPrimaryKey();
            return;
        }
        $this->_organisation->id_okato = $okato["id_okato"];
        unset($okato);
    }

    private function setOktmo($attributes)
    {
        $oktmo = Oktmo::find()->where(["kod_oktmo" => (string)$attributes->code])->asArray()->one();
        if (empty($oktmo) === true) {
            $oktmo = new Oktmo();
            $oktmo->kod_oktmo = (string)$attributes->code;
            $oktmo->name_oktmo = (string)$attributes->name;
            if (!$oktmo->save()) {
                $this->_importErrors++;
            }
            $this->_organisation->id_oktmo = $oktmo->getPrimaryKey();
            return;
        }
        $this->_organisation->id_oktmo = $oktmo["id_oktmo"];
        unset($oktmo);
    }

    private function setVidOrganisation($attributes)
    {
        $type = VidOrganisation::find()->where(["kod_vid" => (string)$attributes->code])->asArray()->one();
        if (empty($type) === true) {
            $type = new VidOrganisation();
            $type->kod_vid = (string)$attributes->code;
            $type->name_vid = (string)$attributes->name;
            if (!$type->save()) {
                $this->_importErrors++;
            }
            $this->_organisation->id_vid = $type->getPrimaryKey();
            return;
        }
        $this->_organisation->id_vid = $type["id_vid"];
        unset($type);
    }

}