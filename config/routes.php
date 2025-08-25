<?
//карта маршрутов

//POSTS
$router->get("", "/posts/index.php"); //главная
// $router->get("posts", "/posts/index.php"); //главная

$router->get("posts", "/posts/show.php"); //один из ресурсов
$router->get("posts/create", "/posts/create.php"); //форма создания нового маршрута
$router->post("posts", "/posts/store.php");
$router->get("posts/edit", "/posts/edit.php");
$router->put("posts", "/posts/update.php");


$router->patch('posts', 'posts/rates.php');
$router->delete("posts", "/posts/destroy.php");

//USERS

$router->get("users", "/users/create.php");
$router->post("users", "/users/create.php");
$router->get("users/login", "/users/login.php");
$router->post("users/login", "/users/login.php");
$router->get("users/reset-password", "/users/reset-password.php");
$router->post("users/reset-password", "/users/reset-password.php");

//Pages
$router->get("contacts", "/contacts.php");

//USERS
// Verb   URI                  Action          Route Name
// GET  /photos                 index          photos.index
// GET  /photos/create          create         photos.create
// POST /photos                   store          photos.store
// GET  /photos/{photo}         show           photos.show
// GET  /photos/{photo}/edit    edit            photos.edit

// PUT/PATCH    /photos/{photo} update          photos.update
// DELETE   /photos/{photo} destroy photos.destroy