<?php
/**
 * JScrollPaneAssetBundle.php
 * @author Revin Roman http://phptime.ru
 */

namespace common\_assets\jquery;

/**
 * Class JScrollPaneAssetBundle
 * @package common\_assets\jquery
 */
class JScrollPaneAssetBundle extends \yii\web\AssetBundle
{

    public $sourcePath = '@bower';

    public $js = [
        'jScrollPane/script/jquery.mousewheel.js',
        'jScrollPane/script/jquery.jscrollpane.min.js',
    ];

    public $depends = [
        \yii\web\JqueryAsset::class,
    ];
}