<?php
// echo "<pre>";
// require_once './core/Application.php';

require_once __DIR__ . '/vendor/autoload.php';

use app\core\Application;
use app\controllers\SiteController;

//no modificar las claves solo los valores.
$config = array(
    'APP_NAME' => 'Framework-PHP-POO-2024'
);


$app = new Application(dirname(__FILE__), $config);

$app->router->get('/', 'home');
$app->router->get('/contact', 'contact');
//de esta forma la funcion call_user_func($callback) recibe un array y entonces
//ejecuta el metodo 'handleContact' de la clase SiteController
$app->router->post('/contact', [SiteController::class, 'handleContact']);
$app->run();

// $app->router->get('/', function () {
//     return 'Hello world ---- ' .
//         "<a href='" . Application::getROOTDIR() .
//         "contact'>CONTACTS</a>";
// });

// $app->router->get('/contact', function () {
//     return 'Contacts';
// });
