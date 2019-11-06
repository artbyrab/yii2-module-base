<?php

$moduleRoot = dirname(dirname(dirname(dirname(__DIR__))));

/**
 * Params
 *
 * Include the params files, if a local file is present, any values in that
 * will override the default params file. The use case for this is when you
 * have local options that are different to the live site, for example emails
 * or any values you can think of.
 */
$params = require($moduleRoot . '/src/tests/app/config/params.php');
if (file_exists($moduleRoot . '/src/tests/app/config/params-local.php')) {
    $params = yii\helpers\ArrayHelper::merge(
        require($moduleRoot . '/src/tests/app/config/params.php'),
        require($moduleRoot . '/src/tests/app/config/params-local.php')
    );
}

/**
 * Database(db)
 *
 * As per the params files, we can have a local database for example on your
 * local set up this may be different to the live site.
 */
$db = require($moduleRoot . '/src/tests/app/config/db.php');
if (file_exists($moduleRoot . '/src/tests/app/config/db-local.php')) {
    $db = require($moduleRoot . '/src/tests/app/config/db-local.php');
}


return [
    'id' => 'yii2-module-console',
    'basePath' => $moduleRoot . '/src/tests/app',
    'bootstrap' => [
        'module-base',
    ],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@artbyrab/Yii2ModuleBase' => $moduleRoot . '/src',
        '@tests' => $moduleRoot . '/src/tests',
    ],
    'components' => [
        'log' => null,
        'cache' => null,
        'db' => $db,
        'mailer' => [
            'useFileTransport' => true,
            'fileTransportPath' => '@artbyrab/Yii2ModuleBase/runtime/mail'
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],
    ],
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => null, // disable non-namespaced migrations if app\migrations is listed below
            'migrationNamespaces' => [
                'artbyrab\Yii2ModuleBase\migrations', // Migrations for the specific project's module
            ],
        ],
    ],
    'modules' => [
        'module-base' => [
            'class' => 'artbyrab\Yii2ModuleBase\Module',
        ],
    ],
];
