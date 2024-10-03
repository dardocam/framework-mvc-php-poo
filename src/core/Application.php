<?php

namespace app\core;

class Application
{
    public Router $router;
    public Request $request;
    private static string $ROOT_PATH;

    public function __construct($rootPath)
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
        self::$ROOT_PATH = $rootPath;
    }

    public function run()
    {
        echo $this->router->resolve();
    }
    public static function getROOTPATH()
    {
        return self::$ROOT_PATH;
    }
    public static function getROOTSOURCE()
    {
        return self::$ROOT_PATH . '/src/';
    }
    public static function getROOTDIR()
    {
        $folders = explode('/', self::$ROOT_PATH);
        return '/' . $folders[count($folders) - 1] . '/';
    }
}
