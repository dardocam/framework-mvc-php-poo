<?php
// echo "<pre>";
// require_once './core/Application.php';

require_once __DIR__ . '/vendor/autoload.php';

use app\core\Application;

//no modificar las claves solo los valores.
$config = array(
    'APP_NAME' => 'Framework-PHP-POO-2024'
);


$app = new Application(dirname(__FILE__), $config);

$app->router->get('/', 'home');
$app->router->get('/contact', 'contact');
$app->run();

// $app->router->get('/', function () {
//     return 'Hello world ---- ' .
//         "<a href='" . Application::getROOTDIR() .
//         "contact'>CONTACTS</a>";
// });

// $app->router->get('/contact', function () {
//     return 'Contacts';
// });
