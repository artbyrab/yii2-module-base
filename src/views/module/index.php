<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use artbyrab\Yii2ModuleBase\assets\ModuleAsset;

ModuleAsset::register($this);

$this->title = Yii::t('Yii2ModuleBase', 'Yii2 Module Base');

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="announcement-update">

    <div class="jumbotron">
        <h1><?php echo $this->title ;?></h1>
        <p><?php echo Yii::t('Yii2ModuleBase', 'View the latest announcements'); ?></p>
    </div>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="announcement-header">
                <h2 class="announcement-header__title">
                    <?php echo Yii::t('Yii2ModuleBase', 'Announcements'); ?>
                </h2>
                <p>
                    <a class="btn btn-success" href="<?php echo \Yii::$app->getUrlManager()->createUrl(['module-base/admin/index']); ?>">
                        <?php echo Yii::t('Yii2ModuleBase', 'Add an announcement'); ?>
                    </a>
                </p>
            </div><!--/.row-->
            <br>
            <div class="row">
                <?php
                echo ListView::widget([
                    'dataProvider' => $announcementsDataProvider,
                    'itemView' => '_announcements-list-view',
                    'layout' => '{items}{pager}',
                ]);
                ;?>
            </div><!--/.row-->
        </div><!--/.col-->
    </div><!--/.row-->
</div><!--/.announcement-update-->



