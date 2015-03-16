<?php
/**
 * Select2AssetBundle.php
 * @author Revin Roman http://phptime.ru
 */

namespace common\_assets\jquery;

/**
 * Class Select2AssetBundle
 * @package common\_assets\jquery
 */
class Select2AssetBundle extends \yii\web\AssetBundle
{

    public $sourcePath = '@bower';

    public $js = [
        'select2/select2.min.js',
        'select2/select2_locale_ru.js',
    ];

    public $depends = [
        \yii\web\JqueryAsset::class,
    ];
}