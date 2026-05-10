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

// DX-CODE Contact Page -> API credentials (server-side only)
define('DXCODE_SITE_ID', 'site_d0436b925c563972');
define('DXCODE_PUBLIC_KEY', 'jpk_4673613909a30cba350221b1bdb824d2');
define('DXCODE_SECRET_KEY', 'jsk_76a3208d77f02be21545b783ffdea27649f331a985da320407c8259ff41403f9');
define('DXCODE_CONTACT_TO', 'dxcode243@gmail.com');

define('TRIAL_EMAIL_LIMIT', 50);
define('RATE_LIMIT_DEFAULT', 60);

define('CSRF_TOKEN_NAME', 'jdev_csrf_token');
define('ENCRYPTION_KEY', 'votre_cle_secrete_ultra_securisee_32_chars');

ini_set('display_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Africa/Kinshasa');
