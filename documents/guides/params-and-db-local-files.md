# Params and DB local files

As the module ships with a test setup that uses a SQLLite database by default we do not have to worry about MYSQL database passwords and keys but the test folder is set up to use local files for security.

For security so database and param attributes are not stored in source control, this module takes advantage of param-local.php and db-local.php files. The files are used in the src/tests/app/config folder. Therefore when you install this module you will only see the params.php and db.php files, you can simply create your own params-local.php and db-local.php to override them. They will be merged by the src/tests/app/config/test.php and console.php files.

The benefit is that you can add say a MYSQL database without commiting the password and username to your source control.

So to create your own files simply do the following:

## Params Local

* Create a params-local.php file
* src/tests/app/config/params-local.php
* Populate the file with your overwritten params as needed they won't be commited to source control, for example API keys or secure passwords

```
<?php

return [
    'yii2ModuleTitle' => Yii::t('Yii2ModuleBase', 'This is my site title'),
    'bingMapsKey' => 'YourAPIKeyHere',
];

```

## DB Local

* Create a db-local.php file
* src/tests/app/config/db-local.php
* Populate the file with your overwritten params as needed they won't be commited to source control, for example API keys or secure passwords

```
<?php

$moduleRoot = dirname(dirname(dirname(dirname(__DIR__))));

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=artbyrab_yii2modulebase',
    'username' => 'root',
    'password' => 'YourSecurePassword',
    'charset' => 'utf8',
];

```

## Where are the local files merged with params?

You can see where they are merge in src/tests/app/config/test.php and console.php for example:
```
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

```

