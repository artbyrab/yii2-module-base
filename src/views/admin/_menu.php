<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;

?>

<?= Nav::widget(
    [
        'options' => [
            'class' => 'nav-tabs',
            'style' => 'margin-bottom: 15px',
        ],
        'items' => [
            [
                'label' => Yii::t('Yii2ModuleBase', 'Home'),
                'url' => ['/module-base/admin/index'],
            ],
            [
                'label' => Yii::t('Yii2ModuleBase', 'Announcements'),
                'url' => ['/module-base/admin/announcement/index'],
            ],
            [
                'label' => Yii::t('Yii2ModuleBase', 'Create'),
                'items' => [
                    [
                        'label' => Yii::t('Yii2ModuleBase', 'Create an Announcement'),
                        'url' => ['/module-base/admin/announcement/create'],
                    ],
                ],
            ],
        ],
    ]
) ?>