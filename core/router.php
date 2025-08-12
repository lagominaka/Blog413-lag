<?
require_once CONFIG . '/routes.php';

$uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
// $uri = parse_url($_SERVER['REQUEST_URI']);
// dd($uri);
if (array_key_exists($uri, $routes) && file_exists(CONTROLLERS . "/posts/$routes[$uri]")) {
   require_once CONTROLLERS . "/posts/$routes[$uri]";
}
if (array_key_exists($uri, $routes) && file_exists(CONTROLLERS . "/users/$routes[$uri]")) {
   require_once CONTROLLERS . "/users/$routes[$uri]";
} else {
   abort();
}
