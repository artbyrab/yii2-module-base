<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="announcement-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'message') ?>

    <?= $form->field($model, 'created_datetime') ?>

    <?= $form->field($model, 'updated_datetime') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('Yii2ModuleBase', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('Yii2ModuleBase', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div><!--/.form-group-->

    <?php ActiveForm::end(); ?>

</div><!--/.announcement-search-->
