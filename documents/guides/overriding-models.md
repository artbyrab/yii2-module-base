# Overriding models

You can override models in the module as it implements the built in Yii2 dependancy injection. You can override models in the module configuration in the app config.

An example of overriding the module's Announcement model with a local version in an app.

```
$config = [
    ...
    'modules' => [
        'listings' => [
            'class' => 'artbyrab\Yii2Listings\Module',
            // this is overriding the default model in artbyrab\Yii2Listings\src\models\Announcement
            'modelMap' => [
                'Announcement' => 'app\models\Announcement',
            ],
        ],
    ],
    ...
];

```

You can read more about how this works in the dependancy-injection.md guide or via the resources below.

## Resources

* Yii2 Dependancy Injection 
    * https://www.yiiframework.com/doc/guide/2.0/en/concept-di-container