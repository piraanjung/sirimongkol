<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       // 'css/site.css',
        'css/mycss.css',
        'adminlte/dist/css/AdminLTE.min.css',
        'adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css',
        'adminlte/dist/css/skins/_all-skins.css',
        'adminlte/bower_components/font-awesome/css/font-awesome.min.css',
        'adminlte/bower_components/Ionicons/css/ionicons.min.css',

    ];
    public $js = [
        'adminlte/dist/js/adminlte.min.js',
        // 'adminlte/bower_components/jquery/dist/jquery.js',
        'adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
