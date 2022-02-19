<?php

if (!defined('APP_NAME'))                       define('APP_NAME', 'Stand Up');
if (!defined('APP_ORGANIZATION'))               define('APP_ORGANIZATION', 'WDM');
if (!defined('APP_OWNER'))                      define('APP_OWNER', 'msaad1999');
if (!defined('APP_DESCRIPTION'))                define('APP_DESCRIPTION', 'Standup - Task mangment');

if (!defined('ALLOWED_INACTIVITY_TIME'))        define('ALLOWED_INACTIVITY_TIME', time()+1*60);

if (!defined('DB_DATABASE'))                    define('DB_DATABASE', '');
if (!defined('DB_HOST'))                        define('DB_HOST','localhost');
if (!defined('DB_USERNAME'))                    define('DB_USERNAME','');
if (!defined('DB_PASSWORD'))                    define('DB_PASSWORD' ,'');
if (!defined('DB_PORT'))                        define('DB_PORT' ,'');

if (!defined('MAIL_HOST'))                      define('MAIL_HOST', 'smtp.gmail.com');
if (!defined('MAIL_USERNAME'))                  define('MAIL_USERNAME', 'xxx@gmail.com');
if (!defined('MAIL_PASSWORD'))                  define('MAIL_PASSWORD', '');
if (!defined('MAIL_ENCRYPTION'))                define('MAIL_ENCRYPTION', 'tls'); // tls  // ssl
if (!defined('MAIL_PORT'))                      define('MAIL_PORT', 587); // 587 //  465