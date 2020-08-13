<?php

//comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

use yii\base\InvalidConfigException;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';


$config = require __DIR__ . '/../config/web.php';

try {
    (new yii\web\Application($config))->run();
} catch (InvalidConfigException $e) {
}
