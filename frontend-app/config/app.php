<?php
/**
 * app.php
 * @author Revin Roman http://phptime.ru
 */

defined('APP_NAME') or define('APP_NAME', 'Application Name');

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$params['component.urlManager']['rules'] = require(__DIR__ . '/urls.php');

// переключение на тестовую БД, если сайт дергает codeception
$isTestExecute = isset($_SERVER['HTTP_USER_AGENT']) && $_SERVER['HTTP_USER_AGENT'] === 'Symfony2 BrowserKit';
$component_db = $params['component.db']['frontend'];
$component_db_test = $params['component.db']['frontend.test'];
if ($isTestExecute) {
    $component_db = $component_db_test;
}

return [
    'id' => 'frontend-app',
    'name' => APP_NAME,
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'frontend\controllers',
    'language' => 'ru_RU',
    'sourceLanguage' => 'ru_RU',
    'bootstrap' => ['log'],
    'modules' => [
        //'blank' => frontend\modules\Blank\Module::class,
        'account' => frontend\modules\Account\Module::class,
    ],
    'components' => [
        'db' => $component_db,
        'db.test' => $component_db_test,
        'session' => $params['component.session'],
        'security' => $params['component.security'],
        'user' => $params['component.user'],
        'postman' => $params['component.postman'],
        'authManager' => $params['component.authManager'],
        'assetManager' => $params['component.assetManager'],
        'urlManager' => $params['component.urlManager'],
        'view' => $params['component.view'],
        'i18n' => $params['component.i18n'],
        'formatter' => $params['component.formatter'],
        'cache' => $params['component.cache'],
        'schemaCache' => $params['component.schemaCache'],
        'sessionCache' => $params['component.sessionCache'],
        'authManagerCache' => $params['component.authManagerCache'],
        'errorHandler' => $params['component.errorHandler'],
        'log' => $params['component.log'],
        'request' => $params['component.request'],
        'authClientCollection' => $params['component.authClientCollection'],
    ],
    'params' => $params,
];
