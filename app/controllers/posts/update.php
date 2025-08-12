<?php
global $db;

$post_id = $_GET['id'] ?? null;
if (!$post_id) {
    die("ID не указан");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $descr = $_POST['descr'] ?? '';
    $content = $_POST['content'] ?? '';

    // Валидация данных (пример)
    if (empty($title) || empty($descr) || empty($content)) {
        die("Заполните все поля");
    }

    // Подготовленный запрос
    $stmt = $db->prepare('UPDATE posts SET title = ?, descr = ?, content = ? WHERE post_id = ?');
    $stmt->execute([$title, $descr, $content, $post_id]);

    // Редирект на страницу просмотра поста (или другую)
    header('Location: /posts/update?id=' . $post_id); // Предполагается, что у вас есть маршрут для просмотра поста
    exit();
} else {
    die("Недопустимый метод запроса");
}
