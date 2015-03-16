<?php
/**
 * GritterAssetBundle.php
 * @author Revin Roman http://phptime.ru
 */

namespace common\_assets\jquery;

/**
 * Class GritterAssetBundle
 * @package common\_assets\jquery
 */
class GritterAssetBundle extends \yii\web\AssetBundle
{

    public $sourcePath = '@bower';

    public $js = [
        'jquery.gritter/js/jquery.gritter.min.js',
    ];

    public $depends = [
        \yii\web\JqueryAsset::class,
    ];
}