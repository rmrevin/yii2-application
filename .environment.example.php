<?php
/**
 * .environment.example.php
 * @author Revin Roman http://phptime.ru
 */

/**
 * Код окружения
 * 'prod' (production), 'dev' (development), 'test', 'staging', etc.
 */
defined('YII_ENV') or define('YII_ENV', 'dev');

/** Debug ружим */
defined('YII_DEBUG') or define('YII_DEBUG', false);

/** Нужно ли редиректить пользователя на ssl версию */
define('USE_SSL', false);

/** Данные подключения к БД */
define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'user');
define('MYSQL_PASS', null);
define('MYSQL_BASE', 'database');
define('MYSQL_DSN', 'mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=' . MYSQL_BASE);

/** Данные подключения к тестовой БД */
define('MYSQL_TEST_DSN', 'mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=database_test');
define('MYSQL_TEST_USER', 'user');
define('MYSQL_TEST_PASS', null);

/** Реквизиты smtp сервера */
define('SMTP_HOST', null);
define('SMTP_PORT', 25);
define('SMTP_USER', null);
define('SMTP_PASSWORD', null);
define('SMTP_ENCRYPT', false);

/**
 * Реквизиты OAuth приложения Facebook
 * @see https://developers.facebook.com/apps
 */
define('FACEBOOK_CLIENT_ID', null);
define('FACEBOOK_CLIENT_SECRET', null);

/**
 * Реквизиты OAuth приложения Github
 * @see https://github.com/settings/applications/new
 */
define('GITHUB_CLIENT_ID', null);
define('GITHUB_CLIENT_SECRET', null);

/**
 * Реквизиты OAuth приложения Google
 * @see https://console.developers.google.com/project
 */
define('GOOGLE_CLIENT_ID', null);
define('GOOGLE_CLIENT_SECRET', null);

/**
 * Реквизиты OAuth приложения Linkedin
 * @see https://www.linkedin.com/secure/developer
 */
define('LINKEDIN_CLIENT_ID', null);
define('LINKEDIN_CLIENT_SECRET', null);

/**
 * Реквизиты OAuth приложения Live
 * @see https://account.live.com/developers/applications
 */
define('LIVE_CLIENT_ID', null);
define('LIVE_CLIENT_SECRET', null);

/**
 * Реквизиты OAuth приложения Twitter
 * @see https://apps.twitter.com/app/new
 */
define('TWITTER_CLIENT_ID', null);
define('TWITTER_CLIENT_SECRET', null);

/**
 * Реквизиты OAuth приложения Vkontakte
 * @see https://vk.com/editapp?act=create
 */
define('VKONTAKTE_CLIENT_ID', null);
define('VKONTAKTE_CLIENT_SECRET', null);

/**
 * Реквизиты OAuth приложения Yandex
 * @see https://oauth.yandex.ru/client/new
 */
define('YANDEX_CLIENT_ID', null);
define('YANDEX_CLIENT_SECRET', null);

require(__DIR__ . '/globals.php');