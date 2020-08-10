<?php


namespace app\models\import;


use DOMDocument;
use DOMXPath;
use ZipArchive;

class Import
{
    /**
     * @var FtpConnection
     */
    private $_ftp;

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
                $bus = simplexml_load_file($file);
                $ns2 = $bus->getNamespaces(true);
                $body = $bus->children($ns2['ns2'])->body;
                $position = $body->position->children($ns2['']);
                $main = $position->main;
                $classifier = $main->classifier->children('');
                print_r($classifier->okfs->name);

                break; //only one file to download
            }
            unlink($file);
        }
    }

}