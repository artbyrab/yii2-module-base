# Migrations

If you want to add your module's migrations to a new Yii2 app you can follow this guide.

* In your app's console.php or whatever config file is powering your console
* Add the module's alias:

```
'@artbyrab/Yii2Module' => '@vendor/artbyrab/yii2-module/src',
```

* Next add the migration alias in the controllerMap:

```
'controllerMap' => [
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationPath' => null, // disable non-namespaced migrations if app\migrations is listed below
        'migrationNamespaces' => [
            //'app\migrations', // Common migrations for the whole application
            'artbyrab\Yii2Module\migrations', // Migrations for the specific project's module
            #'some\extension\migrations', // Migrations for the specific extension
        ],
    ],
    // 'fixture' => [ // Fixture generation command line.
    //     'class' => 'yii\faker\FixtureController',
    // ],
],
```