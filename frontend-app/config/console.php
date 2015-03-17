<?php
/**
 * console.php
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

return [
    'id' => 'frontend-console-app',
    'name' => APP_NAME,
    'basePath' => dirname(__DIR__),
    'aliases' => ['@tests' => '@frontend/tests'],
    'controllerNamespace' => 'frontend\commands',
    'controllerMap' => [
        'fixture' => frontend\commands\FixtureCommand::class,
        'user' => frontend\commands\UserCommand::class,
        'migrate' => [
            'class' => yii\console\controllers\MigrateController::class,
            'templateFile' => '@common/views/migration.php',
        ],
    ],
    'language' => 'ru_RU',
    'sourceLanguage' => 'ru_RU',
    'modules' => [
    ],
    'components' => [
        'db' => $params['component.db']['frontend'],
        'db.test' => $params['component.db']['frontend.test'],
        'cache' => $params['component.cache'],
        'security' => $params['component.security'],
        'user' => $params['component.user'],
        'authManager' => $params['component.authManager'],
        'i18n' => $params['component.i18n'],
        'log' => $params['component.log'],
    ],
    'params' => $params,
];
