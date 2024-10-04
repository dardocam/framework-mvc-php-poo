<?php
require_once __DIR__ . '/vendor/autoload.php';

use app\controllers\SiteController;
use app\core\Application;
use app\core\Configuration;

$config = new Configuration('Framework-PHP-POO-2024');

$app = new Application(dirname(__FILE__), $config->getConfig());

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', 'contact');
$app->router->post('/contact', [SiteController::class, 'handleContact']);

echo $app->run();
