# Using your module in a Yii2 app

If you use this module as a foundation for your own module, then you can use the following guide for using it in any Yii2 app.

## Installing in a Yii2 app

The stages involved to install a module in a Yii2 app are as follows:

* Require via composer
* Add the module to your config file
* Add the module's bootstrap to your config file
* Add the module's alias to your config file
* Add the module's migrations to your config file
* Ensure you have specified an authManager in your config file

### Require via composer

Require the package via composer:
```
"artbyrab/Yii2ModuleBase": "*"
```

### Add the module to your config file

Add the module to your config file as below:
```
$config = [
    'id' => 'MyYii2App',
    ...
    'modules' => [
        'module-base' => [
            'class' => 'artbyrab\Yii2ModuleBase\Module',
        ],
    ],
```

### Add the module's bootstrap to your config file

Add the module to the bootstrap section of your config file, this is the same name as you specified in the section above:

```
$config = [
    'id' => 'MyYii2App',
    'basePath' => '',
    'bootstrap' => [
        'module-base',
    ],
```

### Add the module's migrations to your console config file

```
return [
    ...
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => null, // disable non-namespaced migrations if app\migrations is listed below
            'migrationNamespaces' => [
                'artbyrab\Yii2ModuleBase\migrations', // Migrations for the specific project's module
            ],
        ],
    ],
    ...
```

### Ensure you have specified an authManager in your config file

Please note you only need to do this if you have any RBAC settings in your module.

Please read the Yii2 official guide for more information on specifying an authManager for your app. This will allow for the RBAC

### Overiding routes

For overiding routes please see the full guide.
