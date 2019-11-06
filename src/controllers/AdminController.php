<?php

namespace artbyrab\Yii2ModuleBase\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use artbyrab\Yii2ModuleBase\controllers\BaseAdminController;

/**
 * Admin Controller
 *
 * This is the primary controller for the admin part of the module and will
 * handle all the admin panel functionality.
 */
class AdminController extends BaseAdminController
{
    /**
     * Action Index
     *
     * Home page for the module.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', [
        ]);
    }
}
