<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$moduleRoot = dirname(dirname(dirname(dirname(__DIR__))));

// NOTE: Make sure this file is not accessible when deployed to production
if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
    die('You are not allowed to access this file.');
}

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require($moduleRoot . '/vendor/autoload.php');
require($moduleRoot . '/vendor/yiisoft/yii2/Yii.php');

$config = require($moduleRoot . '/src/tests/app/config/test.php');

(new yii\web\Application($config))->run();
