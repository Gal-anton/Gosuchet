<?php


const FTP_SERVER = 'ftp.bus.gov.ru';
const FTP_USER_NAME = 'gmuext';
const FTP_USER_PASS = 'YctTa34AdOPyld2';
const FTP_ROOT_DIRECTORY = "/GeneralInfo";
const LOCAL_TEMP_DIRECTORY = "../temp/";
error_reporting(E_ALL);
var_dump($_connID = ftp_connect(FTP_SERVER));
var_dump($login_result = ftp_login($_connID, FTP_USER_NAME, FTP_USER_PASS));
var_dump(ftp_nlist($_connID, FTP_ROOT_DIRECTORY));
var_dump(error_get_last());
//$import = new Import();
//$import->start();
