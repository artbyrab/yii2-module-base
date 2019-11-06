<?php

namespace artbyrab\Yii2ModuleBase\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * Asset bundle for this module.
 */
class ModuleAsset extends AssetBundle
{
    // public $basePath = '@webroot';
    // public $baseUrl = '@web';
    public $sourcePath = '@artbyrab/Yii2ModuleBase/assets/source';
    public $css = [
        'css/module.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
