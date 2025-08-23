<?

class Router
{
    private $uri;
    private $method;
    private $routes = []; //все маршруты какие есть в routes.php

    public function __construct()
    {
        $this->uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
        $this->method = isset($_POST['_method']) ? strtoupper($_POST['_method']) : $_SERVER['REQUEST_METHOD'];
    }

    public function match()
    {
        $matched = false;
        foreach ($this->routes as $route) {
            if ($this->uri === $route['uri'] && strtoupper($this->method) === $route['method']) {

                require_once CONTROLLERS . "/{$route['controller']}";
                $matched = true;
                break;
            }
        }
        if (!$matched) {
            abort();
        }
    }
    private function add($uri, $controller, $method)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
        ];
    }
    public function get($uri, $controller)
    {
        $this->add($uri, $controller, "GET");
    }
    public function post($uri, $controller)
    {
        $this->add($uri, $controller, "POST");
    }

    public function delete($uri, $controller)
    {
        $this->add($uri, $controller, "DELETE");
    }
    public function put($uri, $controller)
    {
        $this->add($uri, $controller, "PUT");
}
}