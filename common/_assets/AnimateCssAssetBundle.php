<?php
/**
 * AnimateCssAssetBundle.php
 * @author Revin Roman http://phptime.ru
 */

namespace common\_assets;

/**
 * Class AnimateCssAssetBundle
 * @package common\_assets
 */
class AnimateCssAssetBundle extends \yii\web\AssetBundle
{

    public $sourcePath = '@bower';

    public $js = [
        'animate.css/animate.min.css',
    ];
}