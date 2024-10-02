<?php

namespace app\core;

class Router
{
    protected array $routes = []; //es accesible para las clases que hereden de Router
    // protected array $routes = [
    //     'get' => [
    //         '/'=> callback,
    //         '/contact'
    //     ],
    //     'post' =>
    // ]; 
    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        //aqui nace la request class
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            echo "Not Found";
            exit;
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        echo call_user_func(($callback));
    }

    public function renderView(string $view)
    {
        $view = ucwords($view);
        include_once Application::getROOTSOURCE() . "/views/$view.php";
    }
}
