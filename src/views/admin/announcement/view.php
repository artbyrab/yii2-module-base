<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('Yii2ModuleBase', 'Yii2 Module Base'), 'url' => ['/module-base']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('Yii2ModuleBase', 'Admin'), 'url' => ['/module-base/admin/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('Yii2ModuleBase', 'Announcements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?php $this->beginContent('@artbyrab/Yii2ModuleBase/views/layouts/admin.php') ?>

    <div class="announcement-view">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?= Html::a(Yii::t('Yii2ModuleBase', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('Yii2ModuleBase', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('Yii2ModuleBase', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'title',
                'message:ntext',
                'created_datetime',
                'updated_datetime',
            ],
        ]) ?>

    </div><!--/.announcement-view-->

<?php $this->endContent() ?>
