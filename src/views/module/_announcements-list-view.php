<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>
<div class="col-sm-12">
    <div class="panel panel-default announcement">
        <div class="panel-body">
            <h3 class="announcement__title"><?php echo Html::encode($model->title) ?></h3>
            <p>
                <?php echo Html::encode($model->message) ?>
            </p>
        </div><!--/.panel-body-->
    </div><!--/.panel-->
</div><!--/.col-->
