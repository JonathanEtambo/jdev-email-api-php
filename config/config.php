<?php
/**
 * JDev Mail API - Configuration Globale
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'jdev_mail_api');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

define('APP_NAME', 'JDev Mail API');
define('APP_URL', 'http://localhost/jdevmail');
define('APP_ROOT', dirname(__DIR__));

define('MAIL_FROM_NAME', 'JDev Mail Service');
define('MAIL_FROM_EMAIL', 'jodzoko@gmail.com');

define('TRIAL_EMAIL_LIMIT', 50);
define('RATE_LIMIT_DEFAULT', 60);

define('CSRF_TOKEN_NAME', 'jdev_csrf_token');
define('ENCRYPTION_KEY', 'votre_cle_secrete_ultra_securisee_32_chars');

ini_set('display_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Africa/Kinshasa');
