<?php

namespace artbyrab\Yii2ModuleBase\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use artbyrab\Yii2ModuleBase\models\Announcement;

/**
 * Module controller
 *
 * The default controller in this module.
 */
class ModuleController extends Controller
{
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
        ];
    }

    /**
     * Action Index
     *
     * This renders the modules landing page with the announcement records.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $announcementsQuery = Yii::createObject(Announcement::class)::find()
            ->orderBy(['id' => SORT_DESC]);

        $announcementsDataProvider = new ActiveDataProvider([
            'query' => $announcementsQuery,
            'sort' => false
        ]);

        return $this->render('index', [
            'announcementsDataProvider' => $announcementsDataProvider,
        ]);
    }
}
