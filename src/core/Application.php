<?php

namespace app\core;

class Application
{
    public Router $router;
    public Request $request;
    public Response $response;
    private static string $ROOT_PATH;
    private static array $CONFIGURATION;
    private static Router $routerExposed;
    public static Controller $controller;

    public function __construct(array $config)
    {
        self::$CONFIGURATION = $config;
        self::$ROOT_PATH = dirname(__DIR__, 2);
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        self::$routerExposed = $this->router;
    }

    public function run()
    {
        return $this->router->resolve();
    }
    public static function getROOTPATH()
    {
        return self::$ROOT_PATH;
    }
    public static function getROOTSOURCE()
    {
        return self::$ROOT_PATH . '/src/';
    }
    public static function formatRootPath()
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
