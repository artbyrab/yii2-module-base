# Internationalisation

Firstly ensure you have read the official Yii2 guide:
* https://www.yiiframework.com/doc/guide/2.0/en/tutorial-i18n

## Where is the module translated?

The module gets translated by the modules root Module.php file. This file is located at:
```
/Yii2ModuleBase/Module.php
```

If you open up the file you can see in the init function we register the translations:
```
/**
 * {@inheritdoc}
 */
public function init()
{
    ...
    $this->registerTranslations();
    ...
}
```

This registerTranslations function calls the same function in the init file:
```
/**
 * Register translations
 *
 * This will register the translations. For more information please see 
 * the official Yii2 guide on translations.
 */
public function registerTranslations()
{
    Yii::$app->i18n->translations['Yii2ModuleBase'] = [
        'class' => 'yii\i18n\PhpMessageSource',
        'basePath' => '@artbyrab/Yii2ModuleBase/messages',
        'sourceLanguage' => 'en-GB',
    ];
}
```

This function says that all the translations for this module are done using the prefix 'Yii2ModuleBase'. So any translations in a view will look like:
```
<?php echo Yii::t('Yii2ModuleBase', 'Announcements'); ?>
```

If you do use this module as a base for your own module, then of course you need to ensure you use your own modules name here.

## Module internationalisation config file

As per the Yii2 guide each app/module needs its own translation configuration file. The config file specifies various things like what languages to generate translation files for, what files or folders to scan or ignore and many other things. For more information you should ensure you have read the official Yii2 guide or have a look at the actual config file itself which is quite heavily documented.

The only thing i edited for the config file is that it ignores the tests folder as that contains views for a basic Yii2 app.
```
    ...
    'except' => [
    '.svn',
    '.git',
    '.gitignore',
    '.gitkeep',
    '.hgignore',
    '.hgkeep',
    '/messages',
    // as we have a complete test app in the tests folder we do not want to convert that
    '/tests'
    ],
    ...
```

The config file is what determines how your translation files are handled. This is stored in the folder:
```
/Yii2ModuleBase/src/messages/config.php
```

You can of course generate your own config file

Navigate to:
```
$ cd Yii2ModuleBase/src/tests
```

Then run:
```
$ php yii message/config-template ../messages/config.php
```

## Example translation files

This module comes with a couple of example translation files in the following folder:
```
./Yii2ModuleBase/src/messages
```

## Generating translation files

You can generate your own translation files, with the preference set by your configuration file. Of course first you may want to change the langauges you want to translate to. You can specify the languages by editing the config file first here:
```
/Yii2ModuleBase/src/messages/config.php
```

Once you are happy you can generate the language files, navigate to:
```
$ cd Yii2ModuleBase/src/tests
```

Then run the following:
```
$ php yii message ../messages/config.php
```

## To switch languages 

Currently i will only cover how to switch languages by using your app's config file. In the case of this module the app is located at:
```
/Yii2ModuleBase/src/tests/app/config/test.php
```

If you edit the following to be the language of your choice.
```
'language' => 'en-US',
```

Other methods of switching languages are outside the scope of this module and you should refer to the official Yii2 guide.