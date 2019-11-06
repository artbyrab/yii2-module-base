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


$config = [
    'id' => 'yii2-module-tests',
    'basePath' => $moduleRoot . '/src/tests/app',
    'bootstrap' => [
        'module-base',
    ],
    'aliases' => [
        '@vendor' => $moduleRoot . '/vendor',
        '@artbyrab/Yii2ModuleBase' => $moduleRoot . '/src',
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'en-US',
    'components' => [
        'db' => $db,
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true
        ],
        'assetManager' => [
            'basePath' => $moduleRoot . '/src/tests/app/web/assets',
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
            // but if you absolutely need it set cookie domain to localhost
            /*
            'csrfCookie' => [
                'domain' => 'localhost',
            ],
            */
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'modules' => [
        'module-base' => [
            'class' => 'artbyrab\Yii2ModuleBase\Module',
            'adminLayoutViewFilePath' => '@app/views/layouts/admin.php',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
