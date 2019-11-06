# Overriding controllers

Controllers in the module can be overridden using the built in Yii2 controller map functionality.

To override a controller you should define it in your app's config file. 

In the below example we will override the AnnouncementController in the modules

```
$config = [
    ...
    'controllerMap' => [
        // declares "account" controller using a class name
        'account' => 'app\controllers\UserController',

        // declares "article" controller using a configuration array
        'article' => [
            'class' => 'app\controllers\PostController',
            'enableCsrfValidation' => false,
        ],
    ],
    ...
]
```

You can learn more about overriding controllers via the official Yii2 guide and the resources below.

## Resources

* Official Yii2 guides
    * https://www.yiiframework.com/doc/guide/2.0/en/structure-controllers
* Stack overflow
    * https://stackoverflow.com/questions/38402361/yii2-setting-a-custom-controller-namespace

