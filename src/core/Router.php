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
            return "NOT FOUND";
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        return call_user_func(($callback));
    }

    public function renderView(string $view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    protected function layoutContent()
    {
        ob_start(); //start output buffer --- nada se renderiza en el browser se guarda en buffer interno
        include_once Application::getROOTSOURCE() . "/views/layouts/Main.php";
        return ob_get_clean();
    }
    protected function renderOnlyView($view)
    {
        ob_start();
        $view = ucwords($view);
        include_once Application::getROOTSOURCE() . "/views/$view.php";
        return ob_get_clean();
    }
}
