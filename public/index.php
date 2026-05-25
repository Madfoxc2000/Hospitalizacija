<?php
define('BASE_DIR',   dirname(__DIR__));
define('APP_DIR',    BASE_DIR . '/app');
define('PUBLIC_DIR', __DIR__);

require APP_DIR . '/Core/Router.php';

$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$basePath   = preg_replace('#/public$#', '', $scriptDir);

define('APP_BASE', $basePath);

$router = new Router($basePath);
require APP_DIR . '/routes.php';
$router->dispatch();
