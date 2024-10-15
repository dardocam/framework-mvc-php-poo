<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isPost()) {
            return 'handle submiting data';
        }
        return $this->render('login');
    }

    public function register(Request $request)
    {
        //Para cambiar el layout
        //Application::$controller->layout = 'Auth'; 
        if ($request->isPost()) {
            return 'handle submiting data';
        }
        return $this->render('register');
    }
}
