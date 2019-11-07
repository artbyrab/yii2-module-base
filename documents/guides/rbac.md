# RBAC

RBAC stands for Role Based Access Control and it is implemented in the module. We have an admin section of the module that is restricted to a special type of admin. The special type of admin is 'moduleBaseAdmin'

To view the links below you will need to have followed the installing guide first.

To showcase how you can use RBAC in a module we have the Announcement model and table. This model is simply some announcements which once you have installed the module you can view by navigating to:
```
http://localhost:8080/module-base
```

If you want to edit or create a new announcement record you will need to log in. Try visiting the following before logging in and it should redirect you to the login page:
```
http://localhost:8080/module-base/admin/announcement
```

Once you have logged in your should be able to add your own announcements.

## How the RBAC works in the module

Firstly before going any further if you have not read the official Yii2 guide on RBAC and access control you should here:
* [Yii2 Guide(Authorisation)](https://www.yiiframework.com/doc/guide/2.0/en/security-authorization)

In the module we use the phpManager authorisation as detailed in the Yii2 Authorisation guide:
```
return [
    // ...
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],
        // ...
    ],
];
```

This is already added to config files that are stored as below:
```
Yii2ModuleBase/src/tests/app/config/test.php
```

This means that Yii will use a flat file system to store the authorisation details, that folder in this module is:
```
Yii2ModuleBase/src/tests/app/rbac
```

If you have run the migrations for the module already as detailed in the installing guide you will see this folder already has various files in it which store the RBAC data.

### Limiting access via controllers

As per the Yii2 docs you can limit access control by using the behavior's function in a controller as below:
```
/**
 * {@inheritdoc}
 */
public function behaviors()
{
    return [
        'verbs' => [
            'class' => VerbFilter::className(),
            'actions' => [
                'delete' => ['POST'],
            ],
        ],
        'access' => [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['moduleBaseAdmin'],

                ],
                [
                    'allow' => false,
                    'roles' => ['?'],
                ],
            ],
        ],
    ];
}
```

In this module i have handled this by creating the BaseAdminController at src/controllers/BaseAdminController that all my admin controllers extend from. This way they inherit the behaviors of their parent controller which limits access to the admin area. Currently this only shows any example of not allowing anyone who is not logged in to view that area. I did not implement the specific roles of being able to read and write records which are defined in the modules migration file, which is outside the remit of this module.

### Allowing logged in users to view the admin on the localhost demo

So with the localhost:8080 app you can see when you try to access the admin area you need to log in. This functionality is handled also in the BaseAdminController which you can see here:
```
/**
 * Before action
 *
 * When the environment is dev we will automatically assign the auth role
 * 'moduleBaseAdmin' to any admin/admin or demo/demo user who logs in.
 *
 * On a live site this would not occur and you would need to add the
 * 'moduleBaseAdmin' role to your admin role.
 */
public function beforeAction($event)
{
    if (YII_ENV_DEV) {
        if (!empty(\Yii::$app->user->id)) {
            
            $auth = \Yii::$app->authManager;
            $userId = \Yii::$app->user->id;

            if (!array_key_exists('moduleBaseAdmin', \Yii::$app->authManager->getRolesByUser($userId))) {
                $auth->assign($auth->getRole('moduleBaseAdmin'), $userId);
            }
        }
    }

    return parent::beforeAction($event);
}
```

You can see here i do a check to see if we are in a dev environment via YII_ENV_DEV. This is true because the test app is launched via the index.php file in the src/tests/app/web folder. If you open that file up you can see we set the environment to dev
```
defined('YII_ENV') or define('YII_ENV', 'dev');
```

So all i am doing is assigning the 'moduleBaseAdmin' role to the current user who is logged in, if we are in a dev environment.

Of course on a live site you would not want to use this method. What you instead want to do is create your own role in your main Yii2 app. let's presume that role is called 'admin', well now you need to assign the auth of 'moduleBaseAdmin' to 'admin' so an admin can access all admin areas in this module admin area.

Sounds confusing and it is somewhat is. However you can do this by creating your own migration in your own app, in a similar fashion to the m181222_190100_rbac_init.php migration.

## Creating a migration to allow admin access in your app 

@TODO this needs completing
