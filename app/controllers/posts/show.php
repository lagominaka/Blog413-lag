<?php

global $db;

$title = "Show post";

// Получаем ID поста из GET параметра и преобразуем в целое число. 
// Если ID не передан, считаем его равным 0.
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// SQL запрос для получения конкретного поста по ID.
// Используем подготовленный запрос для защиты от SQL-инъекций. Я исправил запрос.
$sql = "SELECT * FROM posts WHERE post_id = ? LIMIT 1";
$post = $db->query($sql, [$id])->findOrAbort(); //Используем $id для поиска поста.
// dd($post);
// SQL запрос для получения самых популярных постов (по рейтингу).
$sql = "SELECT * FROM posts ORDER BY rating DESC LIMIT 5";
$most_popular_posts = $db->query($sql)->findAll();

// Устанавливаем заголовок страницы (берем из данных поста).
$header = $post['title'];

require_once POSTS_VIEWS . "/show.tmpl.php";

?>
