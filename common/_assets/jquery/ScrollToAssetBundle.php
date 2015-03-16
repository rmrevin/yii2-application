<?php
/**
 * ScrollToAssetBundle.php
 * @author Revin Roman http://phptime.ru
 */

namespace common\_assets\jquery;

/**
 * Class ScrollToAssetBundle
 * @package common\_assets\jquery
 */
class ScrollToAssetBundle extends \yii\web\AssetBundle
{

    public $sourcePath = '@bower';

    public $js = [
        'jquery.scrollTo/jquery.scrollTo.min.js',
    ];

    public $depends = [
        \yii\web\JqueryAsset::class,
    ];
}