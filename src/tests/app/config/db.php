<?php

$moduleRoot = dirname(dirname(dirname(dirname(__DIR__))));

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlite:' . $moduleRoot . '/src/tests/_data/test-database.sqlite3',
    'username' => '',
    'password' => '',
    'charset' => 'utf8',
];
