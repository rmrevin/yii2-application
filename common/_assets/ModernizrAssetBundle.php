<?php
/**
 * ModernizrAssetBundle.php
 * @author Revin Roman http://phptime.ru
 */

namespace common\_assets;

/**
 * Class ModernizrAssetBundle
 * @package common\_assets
 */
class ModernizrAssetBundle extends \yii\web\AssetBundle
{

    public $sourcePath = '@common/_assets/_sources/';

    public $js = [
        'third/modernizr/modernizr.min.js',
    ];
}