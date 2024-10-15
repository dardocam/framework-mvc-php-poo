<?php

namespace app\core;

class Controller
{
    public $layout = 'Main';
    public function render($view, $params = [])
    {
        return Application::getRouter()->renderView($view, $params);
    }
}
