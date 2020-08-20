<?php


namespace app\models;


class FtpConnection
{
    const FTP_SERVER    = 'ftp.bus.gov.ru';
    const FTP_USER_NAME = 'gmuext';
    const FTP_USER_PASS = 'YctTa34AdOPyld2';
    const FTP_ROOT_DIRECTORY = "/GeneralInfo";
    const LOCAL_TEMP_DIRECTORY = "../temp/";

    private $_connID;

    function __construct()
    {
        $this->_connID = ftp_connect(self::FTP_SERVER);
        $this->login();
        ftp_pasv($this->_connID, true);
    }

    function login()
    {
// вход с именем пользователя и паролем
        $login_result = ftp_login($this->_connID, self::FTP_USER_NAME, self::FTP_USER_PASS);

// проверка соединения
        if ((!$this->_connID) || (!$login_result)) {
            echo "Не удалось установить соединение с FTP-сервером!";
        }
    }
    function __destruct()
    {
        ftp_close($this->_connID);
    }

    public function getFile($sourceFile, $destinationFile) {
        // проверка результата
        if (!ftp_get($this->_connID, self::LOCAL_TEMP_DIRECTORY . $destinationFile, $sourceFile, FTP_BINARY)) {
            echo "Не удалось закачать файл!";
            return false;
        }
        return self::LOCAL_TEMP_DIRECTORY . $destinationFile;

    }

    function getFileNames($directory = self::FTP_ROOT_DIRECTORY) {
        return ftp_nlist($this->_connID, $directory);
    }

    function getSize($directory = self::FTP_ROOT_DIRECTORY){
        return ftp_size($this->_connID, $directory);
    }

}