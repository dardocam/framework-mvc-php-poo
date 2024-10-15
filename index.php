<?php
require_once __DIR__ . '/vendor/autoload.php';

use app\controllers\SiteController;
use app\controllers\AuthController;
use app\core\Application;
use app\core\Configuration;

$config = new Configuration('Framework-PHP-POO-2024');

$app = new Application($config->getConfig());

$app->router->get('/', [SiteController::class, 'home']);

$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'contact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'handleLogin']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

echo $app->run();
