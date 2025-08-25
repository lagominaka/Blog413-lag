<?php
global $db;

// Получаем ID поста из GET-параметра
$id = (int) $_GET['id'] ?? 0;
$sql = "SELECT * FROM posts WHERE post_id = ? LIMIT 1";
$post = $db->query($sql, [$id])->findOrAbort();

require_once POSTS_VIEWS . "/edit.tmpl.php";