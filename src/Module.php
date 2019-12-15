<?php

namespace artbyrab\Yii2ModuleBase;

use Yii;
use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;

/**
 * Module for Yii2 Module Base
 *
 * This is the primary module file for the Yii2 Module Base module.
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    /**
     * @var boolean $useModuleUrlRules In your app you can set this to True
     * if you want to False if you do not want to use the module's default
     * routes.
     *
     * For example if you want to change the url format of the module from
     * www.yourapp.com/module-name/admin/controller/action to
     * www.yourapp.com/your-own-admin-url/module-name/controller/action, then
     * just set this in your app's config file while using the module.
     *
     * ...
     * 'modules' => [
     *      'this-modules-name' => [
     *          'class' => 'artbyrab\Yii2ThisModulesName\Module',
     *          'useModuleUrlRules' => False,
     *      ],
     *      ...
     *
     * If you set it to False in your app you will need to create the rules
     * there manually yourself in the url manager component.
     *
     * See the guide for more information.
     */
    public $useModuleUrlRules = true;

    /**
     * @var string The admin layout view file if you wish to specify one in
     * your app.
     *
     * You set this when you add the module to your app's config file as below:
     *
     *  'modules' => [
     *      'products-packages' => [
     *          'class' => 'artbyrab\Yii2ModuleBase\Module',
     *          'adminLayoutViewFilePath' => '@app/views/layouts/admin.php',
     *      ],
     *  ],
     */
    public $adminLayoutViewFilePath;
    
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'artbyrab\Yii2ModuleBase\controllers';

    /**
     * @var string Default route/controller for the module, when you navigate
     * to the modules base route, this controller will be triggered
     */
    public $defaultRoute = 'module';

    /**
     * @var array $modelMap The user defined model map if they wish to override
     * any of the module classes with their own.
     *
     * The model map implements dependancy injection for the module's classes.
     * This was taken from Dektrium's Excellent Yii2 User module:
     *  - https://github.com/dektrium/yii2-user
     *
     * This is merged with the default $_modelMap in the bootstrap function.
     */
    public $modelMap = [];

    /**
     * @var array $_modelMap The default model map defined here in the module.
     *
     * The model map implements dependancy injection for the module's classes.
     * This was taken from Dektrium's Excellent Yii2 User module:
     *  - https://github.com/dektrium/yii2-user
     *
     * If the user of the module wishes to overide any defaults they can set
     * them in their app's config.
     *
     * This is merged with the $modelMap in the bootstrap function.
     */
    private $_modelMap = [
        'Announcement' => 'artbyrab\Yii2ModuleBase\models\Announcement',
        'AnnouncementSearch' => 'artbyrab\Yii2ModuleBase\models\AnnouncementSearch',
    ];

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        $this->registerTranslations();

        // initialize the module with the configuration loaded from config.php
        Yii::configure($this, require __DIR__ . '/config/config.php');

        // set the module alias is not already set, please read function doc
        // for more details
        $this->setModuleAliasIfNotSet();
    }

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $this->defineUrlRules($app);

        $this->mergeModelMaps($app);

        if ($app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'artbyrab\Yii2ModuleBase\commands';
        }
    }

    /**
     * Define the URL rules
     *
     * This will simply define all the URL rules for the module which should
     * be called from the bootstrap function in this file.
     *
     * @param mixed $app the current app.
     */
    public function defineUrlRules($app)
    {
        if ($this->useModuleUrlRules == true) {
            $app->getUrlManager()->addRules([
                new GroupUrlRule([
                    'prefix' => 'tiers/search',
                    'rules' => [
                        '<action:\w+>' => '<action>',
                    ],
                ]),
                new GroupUrlRule([
                    'prefix' => '<module:module-base>/admin',
                    'rules' => [
                        '<controller>/<id:\d+>' => '<controller>/view',
                        '<controller>/<id:\d+>/<action:(update|delete)>' => '<controller>/<action>',
                        '<controller>/<action:create>' => '<controller>/create',
                        '<controller>/<action:\w+>' => '<controller>/<action>',
                    ],
                ]),
            ], false);
        }
    }

    /**
     * Merge model maps
     *
     * This will merge the model maps:
     *  - _modelMap
     *      - The default map for this module as defined by the module author
     *  - modelMap
     *      - The user specific map configured in the app's config file
     *
     * See the docblocks for both the above for more information.
     *
     * @param mixed $app the current app.
     */
    public function mergeModelMaps($app)
    {
        if ($app->hasModule('module-base') && ($module = $app->getModule('module-base')) instanceof Module) {
            $this->_modelMap = array_merge($this->_modelMap, $module->modelMap);

            foreach ($this->_modelMap as $name => $definition) {
                $class = "artbyrab\\Yii2ModuleBase\\models\\" . $name;

                Yii::$container->set($class, $definition);

                $modelName = is_array($definition) ? $definition['class'] : $definition;

                $module->modelMap[$name] = $modelName;
            }
        }
    }

    /**
     * Set module alias if not set
     *
     * Typically with a module you would set the module alias in the module's
     * config file as below:
     *
     * return [
     *    'aliases' => [
     *        '@artbyrab/Yii2ModuleBase' => '@vendor/artbyrab/Yii2ModuleBase/src',
     *    ],
     *
     * However, this causes a conflict with the way i have configured the
     * local Yii2 app in the module. The Yii2 app is stored in src/tests/app
     * and sets the Module alias to be the following in its config file:
     *  - '@artbyrab/Yii2ModuleBase' => $moduleRoot . '/src',
     *
     * So we don't want the module to overwrite this when it is loaded by its
     * config file. However, when the module is used in a live application
     * we DO want its alias to be in the vendor folder.
     *
     * Therefore, rather than set the alias in the config file as normal we
     * will set it here conditionally.
     */
    public function setModuleAliasIfNotSet()
    {
        if (empty(Yii::getAlias('@artbyrab/Yii2ModuleBase'))) {
            Yii::setAlias('@artbyrab/Yii2ModuleBase', '@vendor/artbyrab/Yii2ModuleBase/src');
        }
    }

    /**
     * Register translations
     *
     * This will register the translations for the module.
     *
     * The translation config is stored in src/messages/config.php and the
     * actual translations are in the src/messages folder.
     *
     * For more information please see the official Yii2 guide on translations.
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['Yii2ModuleBase'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@artbyrab/Yii2ModuleBase/messages',
            'sourceLanguage' => 'en-GB',
        ];
    }
}
