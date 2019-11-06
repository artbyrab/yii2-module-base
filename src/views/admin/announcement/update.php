<?php

use yii\helpers\Html;

$this->title = Yii::t('Yii2ModuleBase', 'Update Announcement: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('Yii2ModuleBase', 'Yii2 Module Base'), 'url' => ['/module-base']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('Yii2ModuleBase', 'Admin'), 'url' => ['/module-base/admin/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('Yii2ModuleBase', 'Announcements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('Yii2ModuleBase', 'Update');
?>

<?php $this->beginContent('@artbyrab/Yii2ModuleBase/views/layouts/admin.php') ?>

    <div class="announcement-update">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div><!--/.announcement-update-->

<?php $this->endContent() ?>
