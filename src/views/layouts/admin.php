<?php

/*
 * This is a simple way to render a panel for all the admin views.
 *
 * To use a view simply render the following above and below your content:
 * <?php $this->beginContent('@artbyrab/Yii2Billing/views/layouts/admin.php') ?>
 *      add your content here
 * <?php $this->endContent() ?>
 */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

?>

<div class="clearfix">
</div><!--/.clearfix-->

<!-- Main content -->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <?php echo Yii::t('Yii2ModuleBase', 'Yii2 Module Base Admin area'); ?>
                </strong>
            </div><!--/.panel-heading-->
            <div class="panel-body">
                <?php echo $this->render('@artbyrab/Yii2ModuleBase/views/admin/_menu', []); ?>
                <?php echo $content ?>
            </div><!--/.panel-body-->
        </div><!--/.panel-->
    </div><!--/.col-->
</div><!--/.row-->