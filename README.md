# Framework-mvc-php-poo 2024

- Este es un trabajo realizado con propositos educativos en el contexto de la Escuela Secundaria Técnica.

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
- Almacenan todo en un array interno $routes que utiliza para cargar todas las rutas que se declaren en index.php
- Tiene un método resolve() que utiliza el objeto Request para obtener el path de la url y el tipo de petición http (get,post)
- El método resolve() se encarga de ejecutar la función callback con *call_user_func($function, $params)* esta función también puede recibir en lugar de un callback un array de tipo **['app\controllers\SiteController'method_name']**

# class Request
- Tiene métodos para manejar el path y el http_method 
