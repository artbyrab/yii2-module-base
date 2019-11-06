<?php

use yii\web\GroupUrlRule;

return [
    'aliases' => [
        // Please note the alias is set in the Module.php file as we don't want
        // to set it when testing locally.
    ],
    'components' => [
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
];
