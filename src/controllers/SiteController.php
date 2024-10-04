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

    public static function handleContact(Request $request)
    {
        $body = $request->getBody();
        var_dump($body);
        //now you can create validations... awesome!
    }
}
