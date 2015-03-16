<?php
/**
 * AppAsset.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\_assets;

/**
 * Class AppAsset
 * @package frontend\assets
 */
class AppAsset extends \yii\web\AssetBundle
{

    public $sourcePath = '@frontend/_assets/_sources';

    public $css = [
        'css/angular-material.css',
        'css/angular-material-theme.css',
        'css/styles.css',
    ];

    public $js = [
        'js/scripts.js',
        'js/functions.js',
    ];

    public $depends = [
        \common\_assets\ModernizrAssetBundle::class,
        \common\_assets\AnimateCssAssetBundle::class,
        \common\_assets\URIAssetBundle::class,
        \common\_assets\SweetAlertAssetBundle::class,
        \common\_assets\AngularAssetBundle::class,
        \common\_assets\jquery\ElasticAssetBundle::class,
        \common\_assets\jquery\Select2AssetBundle::class,
        \common\_assets\jquery\GritterAssetBundle::class,
        \common\_assets\jquery\FormAssetBundle::class,
        \common\_assets\jquery\ScrollToAssetBundle::class,
        \common\_assets\jquery\JScrollPaneAssetBundle::class,
        \rmrevin\yii\fontawesome\AssetBundle::class,
        \yii\web\JqueryAsset::class,
        \yii\web\YiiAsset::class,
        \yii\bootstrap\BootstrapAsset::class,
        \yii\bootstrap\BootstrapPluginAsset::class,
    ];
}