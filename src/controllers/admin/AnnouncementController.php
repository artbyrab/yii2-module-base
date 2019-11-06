<?php

namespace artbyrab\Yii2ModuleBase\controllers\admin;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use artbyrab\Yii2ModuleBase\models\Announcement;
use artbyrab\Yii2ModuleBase\models\AnnouncementSearch;
use artbyrab\Yii2ModuleBase\controllers\BaseAdminController;

/**
 * AnnouncementController implements the CRUD actions for Announcement model.
 */
class AnnouncementController extends BaseAdminController
{
    /**
     * Lists all Announcement models.
     * 
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = Yii::createObject(AnnouncementSearch::class);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Announcement model.
     * 
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Announcement model.
     * 
     * If creation is successful, the browser will be redirected to the 'view' 
     * page.
     * 
     * @return mixed
     */
    public function actionCreate()
    {
        $model = Yii::createObject(Announcement::class);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Announcement model.
     * 
     * If update is successful, the browser will be redirected to the 'view' 
     * page.
     * 
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Announcement model.
     * 
     * If deletion is successful, the browser will be redirected to the 'index' 
     * page.
     * 
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Announcement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * 
     * @param integer $id
     * @return Announcement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Yii::createObject(Announcement::class)::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('Yii2ModuleBase', 'The requested page does not exist.'));
    }
}
