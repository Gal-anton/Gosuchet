<?php


namespace app\models;

use ZipArchive;

class Import
{
    /**
     * @var FtpConnection
     */
    private $_ftp;

    /**
     * @var Organisation
     */
    private $_organisation;

    function __construct()
    {
       $this->_ftp = new FtpConnection();
    }

    function start(){
        $directories = $this->_ftp->getFileNames();
        $count = 0;
        foreach ($directories as $directory) {
            $archiveNames = $this->_ftp->getFileNames($directory);
            foreach ($archiveNames as $archiveName) {
                $directory = $this->getFilesFromArchive($archiveName);
                $listOfFiles = $this->scanDirFullPath($directory);
                $this->exploreFiles($listOfFiles);
                if ($count++ > 5) break;
            }
            break;
        }
    }

    private function unzipFiles($archive, $localDir) {
        $zip = new ZipArchive;
        if ($zip->open($archive) === TRUE) {
            // путь к каталогу, в который будут помещены файлы
            $zip->extractTo($localDir);
            $zip->close();
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
                $this->getOrganisationFromXML($xml);
                if (!$this->_organisation->save()) {
                    var_dump($this->_organisation->errors);
                }
            }
            unlink($file);
        }
    }

    private function getOrganisationFromXML($xml) {

        $this->_organisation = new Organisation();

        $ns2 = $xml->getNamespaces(true);
        $body = $xml->children($ns2['ns2'])->body;
        $position = $body->position->children($ns2['']);
        $main = $position->main;
        $other = $position->other;
        $initiator = $position->initiator;
        $classifier = $main->classifier->children('');
        $additional = $position->additional->children('');

        if (isset($classifier->okopf)) $this->setOkopf($classifier->okopf);
        if (isset($main)) $this->setTipOrganisation($main);
        if (isset($classifier->okved)) $this->setOkved($classifier->okved);
        if (isset($classifier->oktmo)) $this->setOktmo($classifier->oktmo);
        if (isset($classifier->okfs)) $this->setVidSob($classifier->okfs);
        if (isset($additional->okato)) $this->setOkato($additional->okato);
        if (isset($additional->institutionType)) $this->setVidOrganisation($additional->institutionType);

        if (isset($initiator->regNum)) $this->_organisation->reg_num = (string)$initiator->regNum;
        if (isset($initiator->fullName)) $this->_organisation->full_name = (string)$initiator->fullName;
        if (isset($main->shortName)) $this->_organisation->short_name = (string)$main->shortName;
        if (isset($initiator->inn)) $this->_organisation->inn = (int)$initiator->inn;
        if (isset($other->founder->fullName)) $this->_organisation->id_owner = (string)$other->founder->fullName;
        if (isset($additional->ppo->name)) $this->_organisation->ppo = (string)$additional->ppo->name;

        return $this->_organisation;
    }
    private function setOkopf($attributes) {
        $okopf = Okopf::findOne(["kod_okopf" => (string) $attributes->code]);
        if (is_null($okopf)) {
            $okopf = new Okopf();
            $okopf->kod_okopf = (string)$attributes->code;
            $okopf->name_okopf = (string)$attributes->name;
            if (!$okopf->save()) {
                var_dump($okopf->errors);
            }
            $okopf = Okopf::findOne(["kod_okopf" => (string)$attributes->code]);
        }
        $this->_organisation->id_okopf = $okopf->getPrimaryKey();
    }

    private function setTipOrganisation($attributes) {
        $tip = TipOrganisation::findOne(["kod_tip" => (string) $attributes->orgType]);
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
            $tip = TipOrganisation::findOne(["kod_tip" => (string)$attributes->orgType]);
        }
        $this->_organisation->id_tip = $tip->getPrimaryKey();
    }

    private function setOkved($attributes)
    {
        $okved = Okved::findOne(["kod_okved" => (string) $attributes->code]);
        if (is_null($okved) === true) {
            $okved = new Okved();
            $okved->kod_okved = (string)$attributes->code;
            $okved->name_okved = (string)$attributes->name;
            if (!$okved->save()) {
                var_dump($okved->errors);
            }
            $okved = Okved::findOne(["kod_okved" => (string)$attributes->code]);
        }
        $this->_organisation->id_okved = $okved->getPrimaryKey();
    }

    private function setVidSob($attributes)
    {
        $okfs = VidSob::findOne(["kod_okfs" => (string)$attributes->code]);
        if (is_null($okfs) === true) {
            $okfs = new VidSob();
            $okfs->kod_okfs = (string)$attributes->code;
            $okfs->name_okfs = (string)$attributes->name;
            if (!$okfs->save()) {
                var_dump($okfs->errors);
            }
            $okfs = VidSob::findOne(["kod_okfs" => (string)$attributes->code]);
        }
        $this->_organisation->id_okfs = $okfs->getPrimaryKey();
        $this->_organisation->id_buj = $okfs->kod_okfs;
    }

    private function setOkato($attributes)
    {
        $okato = Okato::findOne(["kod_okato" => (string) $attributes->code]);
        if (is_null($okato) === true) {
            $okato = new Okato();
            $okato->kod_okato = (string)$attributes->code;
            $okato->name_okato = (string)$attributes->name;
            if (!$okato->save()) {
                var_dump($okato->errors);
            }
            $okato = Okato::findOne(["kod_okato" => (string)$attributes->code]);
        }
        $this->_organisation->id_okato = $okato->getPrimaryKey();
    }

    private function setOktmo($attributes)
    {
        $oktmo = Oktmo::findOne(["kod_oktmo" => (string) $attributes->code]);
        if (is_null($oktmo) === true) {
            $oktmo = new Oktmo();
            $oktmo->kod_oktmo = (string)$attributes->code;
            $oktmo->name_oktmo = (string)$attributes->name;
            if (!$oktmo->save()) {
                var_dump($oktmo->errors);
            }
            $oktmo = Oktmo::findOne(["kod_oktmo" => (string)$attributes->code]);
        }
        $this->_organisation->id_oktmo = $oktmo->getPrimaryKey();
    }

    private function setVidOrganisation($attributes)
    {
        $type = VidOrganisation::findOne(["kod_vid" => (string) $attributes->code]);
        if (is_null($type) === true) {
            $type = new VidOrganisation();
            $type->kod_vid = (string)$attributes->code;
            $type->name_vid = (string)$attributes->name;
            if (!$type->save()) {
                var_dump($type->errors);
            }
            $type = VidOrganisation::findOne(["kod_vid" => (string)$attributes->code]);
        }
        $this->_organisation->id_vid = $type->getPrimaryKey();
    }

}