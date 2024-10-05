<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => "dardocam"
        ];
        return $this->render('home', $params);
    }

    public function contact(Request $request)
    {
        if ($request->isGet()) {
            return $this->render('contact');
        }
        $body = $request->getBody();
        var_dump($body);
        //now you can create validations... awesome!
    }
}
