<?php

global $db;

$title = "Show post";

// Проверяем, существует ли параметр 'id' в массиве $_GET
if (isset($_GET['id'])) {
    // Если существует, преобразуем его в целое число
    $id = (int) $_GET['id'];
} else {
    // Если не существует, устанавливаем $id в 0 или другое значение по умолчанию
    $id = 0; 
}

$sql = "SELECT * FROM posts WHERE post_id = ? LIMIT 1";
$post = $db->query($sql, [$id])->findOrAbort();

$sql = "SELECT * FROM posts ORDER BY rating DESC LIMIT 5";
$most_popular_posts = $db->query($sql)->findAll();

$header = $post['title'];

require_once POSTS_VIEWS . "/show.tmpl.php";

?>