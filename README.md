# Framework-mvc-php-poo 2024

- Este es un trabajo realizado con propósitos educativos en el contexto de la Escuela Secundaria Técnica.

## Especificaciones
- Utiliza [composer](https://getcomposer.org/) 
- Manejo de dependencias por autoload y namespaces
- Requiere archivo .htaccess para redirigir todo hacia el punto de entrada index.php
- Requiere archivo .htaccess para denegar el acceso a la carpeta *src/*
___

# class Application
- En el constructor inicializa un objeto de tipo Router
- Tiene un método run() que llama al métdodo resolve() del Router

# class Router
- Tiene los métodos get y post que reciben por parámetro el path de la url y una función callback
- Almacena todo en un array interno $routes que utiliza para cargar todas las rutas que se declaren en index.php
- Tiene un método resolve() que utiliza el objeto Request para obtener el path de la url y el tipo de petición http (get,post)
- El método resolve() se encarga de ejecutar la función callback con *call_user_func($function, $params)* esta función también puede recibir en lugar de un callback un array de tipo **['app\controllers\SiteController','method_name']**
### function **call_user_func**
- **call_user_func**, es una función que llama a una función callback con un objeto como contexto y devuelve el resultado. Cuando se utiliza con objetos, call_user_func crea una instancia del objeto si no existe y llama al método especificado con ese objeto como contexto.
- Ejemplo: 
    
        //contruyendo la instancia
        $className = 'MyClass';
        $methodName = 'getMethod';
        $object = new $className();
        $result = call_user_func(array($object, $methodName));

        //pasando solo el nombre de la clase
        $result = call_user_func(array(MyClass::class, $methodName));
 

# class Request
- Tiene métodos para manejar el path y el http_method


# class SiteController
- Hereda de Controller
- Desde index.php se invoca a SiteController y se le envia el método que tiene que ejecutar
___
    $app->router->get('/', [SiteController::class, 'home']);

