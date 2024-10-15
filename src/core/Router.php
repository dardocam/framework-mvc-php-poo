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
        $path = ($this->request->getPath() === '/' ? '/' : '/' . $this->request->getPath());
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            //aqui nace la reponse class
            $this->response->setStatusCode(404);
            return $this->renderContent('404 Not Fovvvund');
            // return "NOT FOUND";
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            //instancia del controller
            Application::$controller = new $callback[0]();
            $callback[0] = Application::$controller;
        }

        //$callback es un array que almacena dos strings, el nombre de la clase y el método
        //le estamos pasando la instancia directamente. utilizamos el nombre para instanciarla
        //tipo patrón factory .. instanciacion dinámica
        //$this->request es un $args -> Argumentos adicionales que serán pasados al método o función cuando se invoque.
        return call_user_func($callback, $this->request);
    }

    public function renderView(string $view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderContent(string $viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    protected function layoutContent()
    {
        $layout = 'Main';
        // El búfer de salida es un método para decirle al motor PHP que retenga los datos de salida antes de enviarlos al navegador.
        ob_start(); //start output buffer --- nada se renderiza en el browser se guarda en el buffer de salida
        include_once Application::getROOTSOURCE() . "views/layouts/$layout.php";
        return ob_get_clean(); //devuelve el contenido del buffer actual y borra el buffer de salida
    }
    protected function renderOnlyView($view, $params)
    {
        // $name = $params['name'];
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        $view = ucwords($view);
        include_once Application::getROOTSOURCE() . "views/$view.php";
        return ob_get_clean();
    }
}
