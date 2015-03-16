<?php
/**
 * URIAssetBundle.php
 * @author Revin Roman http://phptime.ru
 */

namespace common\_assets;

/**
 * Class URIAssetBundle
 * @package common\_assets
 */
class URIAssetBundle extends \yii\web\AssetBundle
{

    public $sourcePath = '@bower';

    public $js = [
        'URIjs/src/URI.js',
    ];
}