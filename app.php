<?php
// Paths $ urls
// Name = MazadEgypt
define('PATH', __DIR__ . "/");
define('URL', 'http://localhost/MazadEgypt/');
define('AURL', 'http://localhost/MazadEgypt/admin/');

// db credentials
define('DB_SERVERNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'mazad_egypt');
// include classes
require_once("vendor/autoload.php");
use MazadEgypt\Classes\Request;
use MazadEgypt\Classes\Session;
// objects
$request = new Request;
$session = new Session;
