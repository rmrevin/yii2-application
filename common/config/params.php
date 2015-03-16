<?php
/**
 * params.php
 * @author Revin Roman http://phptime.ru
 */

use yii\helpers\ArrayHelper;

$defaultDbConfig = [
    'class' => yii\db\Connection::class,
    'charset' => 'utf8',
    'enableSchemaCache' => true,
];

return [
    'component.db' => [
        'frontend' => ArrayHelper::merge(
            $defaultDbConfig,
            [
                'dsn' => MYSQL_DSN,
                'username' => MYSQL_USER,
                'password' => MYSQL_PASS,
                'tablePrefix' => 'yii_'
            ]
        ),
        'frontend.test' => ArrayHelper::merge(
            $defaultDbConfig,
            [
                'dsn' => MYSQL_TEST_DSN,
                'username' => MYSQL_TEST_USER,
                'password' => MYSQL_TEST_PASS,
                'tablePrefix' => 'yii_'
            ]
        ),
    ],
    'component.session' => [
        'class' => yii\web\CacheSession::class,
        'cache' => 'sessionCache',
    ],
    'component.security' => [
        'class' => yii\base\Security::class,
        'passwordHashStrategy' => 'password_hash',
    ],
    'component.errorHandler' => [
        'errorAction' => 'site/error',
    ],
    'component.log' => [
        'class' => yii\log\Dispatcher::class,
        'targets' => [],
    ],
    'component.user' => [
        'class' => yii\web\User::class,
        'enableAutoLogin' => true,
        'loginUrl' => ['/'],
    ],
    'component.authManager' => [
        'class' => yii\rbac\DbManager::class,
        'itemTable' => '{{%rbac_item}}',
        'itemChildTable' => '{{%rbac_item_child}}',
        'assignmentTable' => '{{%rbac_assignment}}',
        'ruleTable' => '{{%rbac_rule}}',
        'cache' => 'cache',
    ],
    'component.cache' => [
        'class' => yii\caching\DummyCache::class,
    ],
    'component.sessionCache' => [
        'class' => yii\caching\FileCache::class,
    ],
    'component.assetManager' => [
        'basePath' => '@webroot/assets',
        'baseUrl' => '@web/assets',
        'linkAssets' => true,
        'bundles' => [
            yii\bootstrap\BootstrapAsset::class => [
                'css' => [],
            ],
        ],
    ],
    'component.urlManager' => [
        'class' => yii\web\UrlManager::class,
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'ruleConfig' => [
            'class' => \yii\web\UrlRule::class,
            'encodeParams' => false,
        ],
    ],
    'component.view' => [
        'class' => yii\web\View::class,
    ],
    'component.i18n' => [
    ],
    'component.request' => [
        'cookieValidationKey' => sha1(APP_NAME . '.cookie.key.35d42g46sdh46f34h'),
        'parsers' => [
            'application/json' => yii\web\JsonParser::class,
        ],
    ],
    'component.formatter' => [
        'class' => yii\i18n\Formatter::class,
        'locale' => 'en-US',
        'timeZone' => 'Etc/GMT-0',
        'dateFormat' => 'dd MMMM y',
        'timeFormat' => 'HH:mm',
        'datetimeFormat' => 'dd MMMM y HH:mm',
    ],
];
