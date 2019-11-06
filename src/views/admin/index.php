<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->params['breadcrumbs'][] = ['label' => Yii::t('Yii2ModuleBase', 'Yii2 Module Base'), 'url' => ['/module-base']];
$this->title = Yii::t('Yii2ModuleBase', 'Admin');

$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginContent('@artbyrab/Yii2ModuleBase/views/layouts/admin.php') ?>

<p>
    <?php echo Yii::t(
    'Yii2ModuleBase',
    'This is the admin homepage of the {title} module.',
    ['title' => $this->title,]
    ); ?>
</p>

<?php $this->endContent() ?>



