<?php


use app\controllers\DmuController;

require_once "../controllers/DmuController.php";

const FTP_SERVER = 'ftp.bus.gov.ru';
const FTP_USER_NAME = 'gmuext';
const FTP_USER_PASS = 'YctTa34AdOPyld2';
const FTP_ROOT_DIRECTORY = "/GeneralInfo";
const LOCAL_TEMP_DIRECTORY = "../temp/";
error_reporting(E_ALL);
$controller = new DmuController();
$controller->actionData(64);

