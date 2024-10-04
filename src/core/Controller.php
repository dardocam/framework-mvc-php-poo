<?php

namespace app\core;

class Controller
{
    public function render($view, $params = [])
    {
        return Application::$routerExposed->renderView($view, $params);
    }
}
