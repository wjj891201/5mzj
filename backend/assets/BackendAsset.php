<?php

namespace backend\assets;

use yii\web\View;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class BackendAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web/public';
    public $css = [
        'static/h-ui/css/H-ui.min.css',
        'static/h-ui.admin/css/H-ui.admin.css',
        'lib/Hui-iconfont/1.0.8/iconfont.css',
        'static/h-ui.admin/skin/default/skin.css',
        'static/h-ui.admin/css/style.css',
        'css/common.css'
    ];
    public $js = [
        'lib/jquery/1.9.1/jquery.min.js',
        'lib/layer/2.4/layer.js',
        'static/h-ui/js/H-ui.min.js',
        'static/h-ui.admin/js/H-ui.admin.js',
        'js/common.js'
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];

}
