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

/** Данные подключения к БД ERP */
define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'user');
define('MYSQL_PASS', null);
define('MYSQL_BASE', 'database');
define('MYSQL_DSN', 'mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=' . MYSQL_BASE);

/** Данные подключения к тестовой БД ERP */
define('MYSQL_TEST_DSN', 'mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=database_test');
define('MYSQL_TEST_USER', 'user');
define('MYSQL_TEST_PASS', null);

/** Реквизиты smtp сервера */
define('SMTP_HOST', null);
define('SMTP_PORT', 25);
define('SMTP_USER', null);
define('SMTP_PASSWORD', null);
define('SMTP_ENCRYPT', false);

require(__DIR__ . '/globals.php');