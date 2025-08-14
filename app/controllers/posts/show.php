<?
global $db;

$title = "Show post";
$id = (int)$_GET['id'] ?? 0;
$sql = "SELECT * FROM posts WHERE post_id = ? LIMIT 1";
$post = $db->query($sql, [$id])->findOrAbort();


$sql = "SELECT * FROM posts ORDER BY rating DESC LIMIT 5";
$most_popular_posts = $db->query($sql)->findAll();

$header = $post['title'];

require_once POSTS_VIEWS . "/show.tmpl.php";
