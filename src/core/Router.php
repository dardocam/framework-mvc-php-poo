<?php

namespace app\core;

class Router
{
    // protected array $routes = [
    //     'get' => [
    //         '/'=> callback,
    //         '/contact'
    //     ],
    //     'post' =>
    // ]; 
    //es accesible para las clases que hereden de Router
    protected array $routes = [];
    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        //aqui nace la request class
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            //aqui nace la reponse class
            $this->response->setStatusCode(404);
            return $this->renderContent('404 Not Found');
            // return "NOT FOUND";
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

    public function renderContent(string $viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    protected function layoutContent()
    {
        // El búfer de salida es un método para decirle al motor PHP que retenga los datos de salida antes de enviarlos al navegador.
        ob_start(); //start output buffer --- nada se renderiza en el browser se guarda en el buffer de salida
        include_once Application::getROOTSOURCE() . "/views/layouts/Main.php";
        return ob_get_clean(); //devuelve el contenido del buffer actual y borra el buffer de salida
    }
    protected function renderOnlyView($view)
    {
        ob_start();
        $view = ucwords($view);
        include_once Application::getROOTSOURCE() . "/views/$view.php";
        return ob_get_clean();
    }
}
