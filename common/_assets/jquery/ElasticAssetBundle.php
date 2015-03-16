<?php
/**
 * ElasticAssetBundle.php
 * @author Revin Roman http://phptime.ru
 */

namespace common\_assets\jquery;

/**
 * Class ElasticAssetBundle
 * @package common\_assets\jquery
 */
class ElasticAssetBundle extends \yii\web\AssetBundle
{

    public $sourcePath = '@common/_assets/_sources/';

    public $js = [
        'third/jquery.elastic/jquery.elastic.source.js',
    ];

    public $depends = [
        \yii\web\JqueryAsset::class,
    ];
}