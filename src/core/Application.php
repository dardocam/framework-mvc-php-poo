<?php

namespace app\core;

class Application
{
    public Router $router;
    public Request $request;
    public Response $response;
    private static string $ROOT_PATH;
    private static array $CONFIGURATION;
    private static $routerExposed;

    public function __construct(string $rootPath, array $config)
    {
        self::$CONFIGURATION = $config;
        self::$ROOT_PATH = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        self::$routerExposed = $this->router;
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
    public static function getAPPNAME()
    {
        return self::$CONFIGURATION['APP_NAME'];
    }
    public static function getRouter()
    {
        return self::$routerExposed;
    }
}
