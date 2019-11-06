<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('Yii2ModuleBase', 'Announcements');
$this->params['breadcrumbs'][] = ['label' => Yii::t('Yii2ModuleBase', 'Yii2 Module Base'), 'url' => ['/module-base']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('Yii2ModuleBase', 'Admin'), 'url' => ['/module-base/admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginContent('@artbyrab/Yii2ModuleBase/views/layouts/admin.php') ?>

    <div class="announcement-index">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?= Html::a(Yii::t('Yii2ModuleBase', 'Create Announcement'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'title',
                'message:ntext',
                'created_datetime',
                'updated_datetime',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div><!--/.announcement-index-->

<?php $this->endContent() ?>
