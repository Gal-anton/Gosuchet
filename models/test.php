<?php


use app\models\Import;

include_once "FtpConnection.php";
include_once "Import.php";


$import = new Import();
$import->start();

