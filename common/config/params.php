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
    'schemaCache' => 'schemaCache',
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
        'cache' => 'rbacCache',
    ],
    'component.cache' => [
        'class' => yii\caching\DbCache::class, // apc cache not available in cli!
        'keyPrefix' => 'normal-',
    ],
    'component.schemaCache' => [
        'class' => yii\caching\ApcCache::class, // apc cache not available in cli!
        'keyPrefix' => 'schema-',
    ],
    'component.sessionCache' => [
        'class' => yii\caching\ApcCache::class, // apc cache not available in cli!
        'keyPrefix' => 'session-',
    ],
    'component.rbacCache' => [
        'class' => yii\caching\ApcCache::class, // apc cache not available in cli!
        'keyPrefix' => 'rbac-',
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
    'component.authClientCollection' => [
        'class' => yii\authclient\Collection::class,
        'clients' => [
            'facebook' => [
                'class' => yii\authclient\clients\Facebook::class,
                'clientId' => FACEBOOK_CLIENT_ID,
                'clientSecret' => FACEBOOK_CLIENT_SECRET,
            ],
            'github' => [
                'class' => yii\authclient\clients\GitHub::class,
                'clientId' => GITHUB_CLIENT_ID,
                'clientSecret' => GITHUB_CLIENT_SECRET,
            ],
            'google' => [
                'class' => yii\authclient\clients\GoogleOAuth::class,
                'clientId' => GOOGLE_CLIENT_ID,
                'clientSecret' => GOOGLE_CLIENT_SECRET,
            ],
            'linkedin' => [
                'class' => yii\authclient\clients\LinkedIn::class,
                'clientId' => LINKEDIN_CLIENT_ID,
                'clientSecret' => LINKEDIN_CLIENT_SECRET,
            ],
            'live' => [
                'class' => yii\authclient\clients\Live::class,
                'clientId' => LIVE_CLIENT_ID,
                'clientSecret' => LIVE_CLIENT_SECRET,
            ],
            'twitter' => [
                'class' => yii\authclient\clients\Twitter::class,
                'consumerKey' => TWITTER_CLIENT_ID,
                'consumerSecret' => TWITTER_CLIENT_SECRET,
            ],
            'vkontakte' => [
                'class' => yii\authclient\clients\VKontakte::class,
                'clientId' => VKONTAKTE_CLIENT_ID,
                'clientSecret' => VKONTAKTE_CLIENT_SECRET,
            ],
            'yandex' => [
                'class' => yii\authclient\clients\YandexOAuth::class,
                'clientId' => YANDEX_CLIENT_ID,
                'clientSecret' => YANDEX_CLIENT_SECRET,
            ],
        ],
    ],
];
