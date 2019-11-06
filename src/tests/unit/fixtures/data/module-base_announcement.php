<?php

use artbyrab\Yii2ModuleBase\models\Announcement;

return [
    'announcement_1' => [
        'id' => '1',
        'title' => 'Hello World',
        'message' => 'Hello world!',
        'created_datetime' => date('Y-m-d H:i:s'),
        'updated_datetime' => date('Y-m-d H:i:s'),
    ],
    'announcement_2' => [
        'id' => '2',
        'title' => 'Yii2 Module Base is launching soon',
        'message' => 'Good news, the Yii2 Module Base is launching soon, making it easy to create modules',
        'created_datetime' => date('Y-m-d H:i:s'),
        'updated_datetime' => date('Y-m-d H:i:s'),
    ],
    'announcement_3' => [
        'id' => '3',
        'title' => 'Did you know? You can easily test your module with Functional and Unit tests',
        'message' => 'Unit and functional testing Yii2 modules just got easier with the Yii2 Module Base. With built in struture and code to help you easily test, there is no reason not too.',
        'created_datetime' => date('Y-m-d H:i:s'),
        'updated_datetime' => date('Y-m-d H:i:s'),
    ],
    'announcement_4' => [
        'id' => '4',
        'title' => 'Easily implement RBAC in your module',
        'message' => 'It has never been easier to implement RBAC in your module.',
        'created_datetime' => date('Y-m-d H:i:s'),
        'updated_datetime' => date('Y-m-d H:i:s'),
    ],
];
