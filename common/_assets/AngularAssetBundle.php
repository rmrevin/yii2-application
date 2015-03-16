<?php
/**
 * Created by PhpStorm.
 * User: revin
 * Date: 16.12.14
 * Time: 18:41
 */

namespace common\_assets;

/**
 * Class AngularAssetBundle
 * @package common\_assets
 */
class AngularAssetBundle extends \yii\web\AssetBundle
{

    public $sourcePath = '@bower';

    public $js = [
        'angular/angular.js',
        'angular-cookies/angular-cookies.min.js',
        'angular-loader/angular-loader.min.js',
        'angular-sanitize/angular-sanitize.min.js',
        'angular-animate/angular-animate.min.js',
        'angular-resource/angular-resource.min.js',
        'angular-cache/dist/angular-cache.min.js',
        'angular-bootstrap/ui-bootstrap-tpls.min.js',
        'angular-ui-router/release/angular-ui-router.min.js',
        'angular-loading-bar/build/loading-bar.min.js',
        'angular-material/angular-material.min.js',
    ];

    public $depends = [
        \yii\web\JqueryAsset::class,
    ];
}