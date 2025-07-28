<?php

$title = 'Contacts';
$header = 'Contact us';
$sql = "SELECT * FROM `posts` ORDER BY `post_id` DESC";
$posts = $db->query($sql)->findAll();

$sql = "SELECT * FROM posts ORDER BY rating DESC LIMIT 5";
$most_popular_posts = $db->query($sql)->findAll();

require_once POSTS_VIEWS.'/contacts.tmpl.php';

