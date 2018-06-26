<?php

error_reporting(E_ALL ^ E_WARNING); // Remove warning messages

define('DEFAULT_CONTROLLER', 'home');
define('DEFAULT_ACTION', 'index');
define('DEFAULT_LAYOUT', 'default');
define('BASE_HOST', str_replace('/index.php', '', $_SERVER['PHP_SELF']));

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'meme_system');

define("IMAGE_PATH", '/content/images');
define("CSS_PATH", '/content/styles');
define("SCRIPTS_PATH", '/content/scripts');
