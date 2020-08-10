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

        foreach ($directories as $directory) {
            $archiveNames = $this->_ftp->getFileNames($directory);
            foreach ($archiveNames as $archiveName) {
                $directory = $this->getFilesFromArchive($archiveName);
                $listOfFiles = $this->scanDirFullPath($directory);
                $this->exploreFiles($listOfFiles);
                break;
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
        //unlink($localFile);

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
                $organisation = $this->getOrganisationFromXML($xml);
                $organisation->save();
                break; //only one file to download
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
        if (isset($classifier->okfs)) $this->setVidSob($classifier->okfs);
        if (isset($additional->okato)) $this->setOkato($additional->okato);
        if (isset($additional->oktmo)) $this->setOktmo($additional->oktmo);
        if (isset($additional->institutionType)) $this->setVidOrganisation($additional->institutionType);
        //if (isset($additional->ppo)) $this->setPpo();

        if (isset($initiator->regNum)) $this->_organisation->reg_num = (string) $initiator->regNum;
        if (isset($initiator->fullName)) $this->_organisation->full_name = (string) $initiator->fullName;
        if (isset($main->shortName)) $this->_organisation->short_name = (string) $main->shortName;
        if (isset($initiator->inn)) $this->_organisation->inn = (string) $initiator->inn;
        if (isset($other->founder->fullName)) $this->_organisation->id_owner = (string) $other->founder->fullName;

        return $this->_organisation;
    }
    private function setOkopf($attributes) {
        $okopf = Okopf::findOne(["kod_okopf" => (string) $attributes->code]);
        if (is_null($okopf)) {
            $okopf = new Okopf();
            $okopf->kod_okopf = (string) $attributes->code;
            $okopf->name_okopf = (string) $attributes->name;
            $okopf->save();
            $okopf = Okopf::findOne(["kod_okopf" => (string) $attributes->code]);
        }
        $this->_organisation->id_okopf = $okopf;
    }

    private function setTipOrganisation($attributes) {
        $tip = TipOrganisation::findOne(["kod_tip" => (string) $attributes->orgType]);
        if (is_null($tip)) {
            $tip = new TipOrganisation();
            $tip->kod_tip = (string) $attributes->orgType;
            switch ($tip->kod_tip) {
                case "03": $tip->name_tip = "Бюджетное учреждение"; break;
                case "08": $tip->name_tip = "Казеное учреждение"; break;
                case "10": $tip->name_tip = "Автономное учреждение";
            }
            $tip->save();
            $tip = TipOrganisation::findOne(["kod_tip" => (string) $attributes->orgType]);
        }
        $this->_organisation->id_tip = $tip;
    }

    private function setOkved($attributes)
    {
        $okved = Okved::findOne(["kod_okved" => (string) $attributes->code]);
        if (is_null($okved) === true) {
            $okved = new Okved();
            $okved->kod_okved = (string) $attributes->code;
            $okved->name_okved = (string) $attributes->name;
            $okved->save();
            $okved = Okved::findOne(["kod_okved" => (string) $attributes->code]);
        }
        $this->_organisation->id_okved = $okved;
    }

    private function setVidSob($attributes)
    {
        $okfs = VidSob::findOne(["kod_okfs" => (string) $attributes->code]);
        if (is_null($okfs) === true) {
            $okfs = new VidSob();
            $okfs->kod_okfs = (string) $attributes->code;
            $okfs->name_okfs = (string) $attributes->name;
            $okfs->save();
            $okfs = VidSob::findOne(["kod_okfs" => (string) $attributes->code]);
        }
        $this->_organisation->id_okfs = $okfs;
        $this->_organisation->id_buj = $okfs;
    }

    private function setOkato($attributes)
    {
        $okato = Okato::findOne(["kod_okato" => (string) $attributes->code]);
        if (is_null($okato) === true) {
            $okato = new Okato();
            $okato->kod_okato = (string) $attributes->code;
            $okato->name_okato = (string) $attributes->name;
            $okato->save();
            $okato = Okato::findOne(["kod_okato" => (string) $attributes->code]);
        }
        $this->_organisation->id_okato = $okato;
    }

    private function setOktmo($attributes)
    {
        $oktmo = Oktmo::findOne(["kod_oktmo" => (string) $attributes->code]);
        if (is_null($oktmo) === true) {
            $oktmo = new Oktmo();
            $oktmo->kod_okato = (string) $attributes->code;
            $oktmo->name_okato = (string) $attributes->name;
            $oktmo->save();
            $oktmo = Oktmo::findOne(["kod_oktmo" => (string) $attributes->code]);
        }
        $this->_organisation->id_oktmo = $oktmo;
    }

    private function setVidOrganisation($attributes)
    {
        $type = VidOrganisation::findOne(["kod_vid" => (string) $attributes->code]);
        if (is_null($type) === true) {
            $type = new VidOrganisation();
            $type->kod_vid = (string) $attributes->code;
            $type->name_vid = (string) $attributes->name;
            $type->save();
            $type = VidOrganisation::findOne(["kod_vid" => (string) $attributes->code]);
        }
        $this->_organisation->id_vid = $type;
    }
}