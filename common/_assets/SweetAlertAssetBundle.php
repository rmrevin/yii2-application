<?php
/**
 * SweetAlertAssetBundle.php
 * @author Revin Roman http://phptime.ru
 */

namespace common\_assets;

/**
 * Class SweetAlertAssetBundle
 * @package common\_assets
 */
class SweetAlertAssetBundle extends \yii\web\AssetBundle
{

    public $sourcePath = '@common/_assets/_sources/';

    public $js = [
        'third/bootstrap-sweetalert/lib/sweet-alert.js',
    ];
}