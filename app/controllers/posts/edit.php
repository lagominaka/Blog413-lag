<?php
global $db;
// Получаем ID поста из GET-параметра
$id = (int)$_GET['id'] ?? 0;
$sql = "SELECT * FROM posts WHERE post_id = ? LIMIT 1";
$post = $db->query($sql, [$id])->findOrAbort();

// Если пост не найден, сообщаем об этом и остаемся на странице
if (!$post) {
    $_SESSION['warning'] = "The post was not found.";
    require_once POSTS_VIEWS . "/edit.tmpl.php"; // Отображаем форму с ошибкой
    exit;
}
// Обработка отправленной формы (POST запрос)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fillable = ['title', 'descr', 'content'];
    $data = loadRequestData($fillable);
    //Валидация
    $rules = [
        'title' => [
            'required' => true,
            'min' => 3,
            'max' => 50,
        ],
        'descr' => [
            'required' => true,
            'min' => 5,
            'max' => 50,
        ],
        'content' => [
            'required' => true,
            'min' => 5,
        ],
    ];

    $validator = new Validator();
    $validator->validate($data, $rules);

    if (!$validator->hasErrors()) {
        $sql = "UPDATE posts SET title = ?, descr = ?, content = ? WHERE id = ?";
        $data['slug'] = str_replace(" ", "-", $data['title']);
    }
}

require_once POSTS_VIEWS . "/edit.tmpl.php";
