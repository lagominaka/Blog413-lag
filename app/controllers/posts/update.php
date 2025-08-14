<?php
global $db;
require_once CLASSES . '\Validator.php';

// Проверяем, что запрос отправлен методом POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Invalid request method.";
    exit;
}

// Получаем ID поста из POST-параметра
$post_id = $_POST['post_id'] ?? null;

if (!$post_id) {
    echo "The ID of the update post is not specified.";
    exit;
}

// Получаем данные поста из БД, чтобы проверить, существует ли он
$sql = "SELECT * FROM posts WHERE post_id = ?";
$post = $db->query($sql, [$post_id])->find();

if (!$post) {
    echo "The post was not found.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fillable = ['title', 'descr', 'content'];
    $data = loadRequestData($fillable);
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
        $data['slug'] = str_replace(" ", "-", $data['title']);
        $sql = "UPDATE posts SET title = ?, slug = ?, descr = ?, content = ? WHERE post_id = ?";
        
        if ($db->query($sql, [$data['title'], $data['slug'], $data['descr'], $data['content'], $post_id])) {
            
            $_SESSION['success'] = "The post has been successfully changed.";
            redirect(PATH);
            
        } else {
            $_SESSION['warning'] = "Error updating the post.";
            redirect('');
            
        }
    } else {
        $_SESSION['errors'] = $validator->getErrors();
        header("Location: /posts/edit?id={$post_id}");
        exit;
    }
}

header("Location: /posts/edit?id={$post_id}");
exit;
?>
