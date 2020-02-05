<?php

namespace artbyrab\Yii2ModuleBase\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Base Admin Controller
 *
 * The base admin controller will implement the RBAC for the admin controllers
 * in the module. As we want to only allow logged in users, and also logged in
 * users that have been assigned the role 'moduleBaseAdmin' which is the
 * admin role for this module.
 *
 * Additionally this will allow you to set a layout view file for any admin
 * area controllers.
 */
class BaseAdminController extends Controller
{
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

        $this->setAdminLayout();

        return parent::beforeAction($event);
    }

    /**
     * Set the admin layout view file
     *
     * This will set the admin layout view file is provided. This allows you
     * to easily wrap the admin views in your own admin layout theme files.
     *
     * You should set the layout file as an alias in your config module
     * options as below:
     *
     *  ...
     *  'modules' => [
     *      'module-base' => [
     *          'class' => 'artbyrab\Yii2ModuleBase\Module',
     *          'adminLayoutViewFilePath' => '@app/views/layouts/admin.php',
     *      ],
     *  ],
     */
    public function setAdminLayout()
    {
        $module = Yii::$app->controller->module->id;

        $moduleObject = \Yii::$app->getModule($module);

        if (!empty($moduleObject)) {
            $adminModuleViewFilePath = $moduleObject->adminLayoutViewFilePath;

            if (isset($adminModuleViewFilePath) && !empty($adminModuleViewFilePath)) {
                $this->layout = $adminModuleViewFilePath;
            }
        }
    }
    
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
}
