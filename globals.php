<?php
/**
 * globals.php
 * @author Revin Roman http://phptime.ru
 */

use rmrevin\yii\minify\HtmlCompressor;
use yii\helpers\Html;

@umask(0002);

define('BASE_PATH', __DIR__);

define('JS_DATE_FORMAT', 'dd.mm.yyyy');
define('JS_DATETIME_FORMAT', 'dd.mm.yyyy hh:ii');

/**
 * Dumps a variable in terms of a string.
 * This method achieves the similar functionality as var_dump and print_r
 * but is more robust when handling complex objects such as Yii controllers.
 * @param mixed $var variable to be dumped
 * @param integer $depth maximum depth that the dumper should go into the variable. Defaults to 10.
 * @param boolean $highlight whether the result should be syntax-highlighted
 * @return void output the string representation of the variable
 */
function dump($var, $depth = 10, $highlight = true)
{
    echo \yii\helpers\VarDumper::dumpAsString($var, $depth, $highlight);
}

/**
 * @inherit
 */
function Db()
{
    return \Yii::$app->getDb();
}

/**
 * @inherit
 */
function Security()
{
    return \Yii::$app->getSecurity();
}

/**
 * @inherit
 */
function YiiLog()
{
    return \Yii::$app->getLog();
}

/**
 * @inherit
 */
function ErrorHandler()
{
    return \Yii::$app->getErrorHandler();
}

/**
 * @inherit
 */
function Cache()
{
    return \Yii::$app->getCache();
}

/**
 * @inherit
 */
function Formatter()
{
    return \Yii::$app->getFormatter();
}

/**
 * @inherit
 */
function Request()
{
    return \Yii::$app->getRequest();
}

/**
 * @inherit
 */
function Response()
{
    return \Yii::$app->getResponse();
}

/**
 * @inherit
 */
function View()
{
    return \Yii::$app->getView();
}

/**
 * @inherit
 */
function UrlManager()
{
    return \Yii::$app->getUrlManager();
}

/**
 * @inherit
 */
function I18N()
{
    return \Yii::$app->getI18n();
}

/**
 * @inherit
 */
function Mailer()
{
    return \Yii::$app->getMailer();
}

/**
 * @inherit
 */
function AuthManager()
{
    return \Yii::$app->getAuthManager();
}

/**
 * @return yii\web\Session
 */
function Session()
{
    return \Yii::$app->get('session');
}

/**
 * @inherit
 */
function User()
{
    return \Yii::$app->getUser();
}

/**
 * @inherit
 */
function AssetManager()
{
    return \Yii::$app->getAssetManager();
}

/**
 * @return yii\authclient\Collection
 */
function AuthClientCollection()
{
    return \Yii::$app->get('authClientCollection');
}

/**
 * @return \services\File\Service
 */
function FileService()
{
    return Yii::$app->getModule('service.file');
}

/**
 * @return \services\Activity\Service
 */
function ActivityService()
{
    return Yii::$app->getModule('service.activity');
}

/**
 * @param $value
 * @return int|null
 */
function nulled($value)
{
    $value = (int)$value;

    return empty($value) ? null : $value;
}

/**
 * @param string $str
 * @return string
 */
function str_clean($str)
{
    return trim(preg_replace('/(\r?\n){2,}/', "\n\n", strip_tags($str)));
}