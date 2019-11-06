<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Yii2 Module Base</h1>

        <p class="lead">Welcome to the Yii2 Module Base example site.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>

    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h2>Create modules easily</h2>

                <p>You can use the Yii2 Module Base as a foundation to easily 
                build Yii2 modules. To get started please explore the module.</p>

                <p><a class="btn btn-default" href="
                    <?php echo \Yii::$app->getUrlManager()->createUrl(['module-base']); ?>">
                        View the module's main page
                </a></p>
            </div>
            <div class="col-lg-4">
                <h2><?php echo Yii::t('app', 'Admin areas in your modules'); ?></h2>

                <p>There is an admin area that allows you to perform CRUD 
                operations on a table.</p>

                <p><a class="btn btn-default" href="
                    <?php echo \Yii::$app->getUrlManager()->createUrl(['module-base/admin/index']); ?>">
                        View the module's admin area
                </a></p>
            </div>
            <div class="col-lg-4">
                <h2>Announcement records</h2>

                <p>In the module is a table for creating announcements. You can 
                view the announcements on the module's home page or edit
                then in the admin area.</p>

                    <p><a class="btn btn-default" href="
                    <?php echo \Yii::$app->getUrlManager()->createUrl(['module-base/admin/announcement/index']); ?>">
                        Yii2 Module Base
                </a></p>
            </div>
        </div>
    </div>
</div>
