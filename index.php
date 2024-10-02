<?php
echo "<pre>";
// require_once './core/Application.php';

require_once __DIR__ . '/vendor/autoload.php';

use app\core\Application;

$app = new Application(dirname(__FILE__));

$app->router->get('/', function () {
    return 'Hello world ---- ' .
        "<a href='" . Application::getROOTDIR() .
        "contact'>CONTACTS</a>";
});
$app->router->get('/contact', 'contact');
// $app->router->get('/contact', function () {
//     return 'Contacts';
// });
$app->run();
