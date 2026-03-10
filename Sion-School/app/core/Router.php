<?php
namespace App\Core;
use App\Controllers\StudentController;
class Router
{

    private array $routes = [];
    public function add(string $method, string $uri, string $controller, string $function)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'function' => $function
        ];
    }
    
   public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


        foreach ($this->routes as $route) {
            $pattern = str_replace(
                '{id}',
                '([0-9]+)',
                $route['uri'],
            );

            $pattern = '#^' . $pattern . '$#';
            // student/([0-9]+)

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // menghapus elemen pertama yang merupakan full match
                require_once '../app/controllers/' . $route['controller'] . '.php';

                $controllerClass = 'App\\Controllers\\' . $route['controller'];
                $controller = new $controllerClass();
                $function = $route['function'];

                call_user_func_array([$controller, $function], $matches);
                // index($parameter1, $parameter2, ...);
                //ex: call_user_func_array(['StudentController','index'], [1,2]);
                return;
            }

        }
}
}
?>