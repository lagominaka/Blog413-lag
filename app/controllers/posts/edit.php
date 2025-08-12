<?php

global $db;

require_once VIEWS . '\components\header.php';
$title = "Blog/Edit post";
?>
<div class="col-10">
    <h3 class="mt-3 text-center"><span class="me-2">Edit Post</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
        </svg>
    </h3>

    <?php
    $postId = $_GET['id'] ?? null; // Получаем ID поста из GET-параметра, если он есть

    if ($postId) { // Проверяем, что ID поста существует
        $db = DB::getInstance(); // Получаем экземпляр класса DB

        // Получаем данные поста из базы данных и проверяем на false!
        $queryResult = $db->query("SELECT post_id, title, descr, content FROM posts WHERE post_id = :id", [':id' => $postId]);

        if ($queryResult !== false) { // Проверяем, что запрос выполнен успешно
            $post = $queryResult->find();

            if ($post) { // Проверяем, найден ли пост
                require_once VIEWS . '/posts/edit.tmpl.php'; // Подключаем шаблон формы редактирования
            } else {
                echo "Post  ID " . htmlspecialchars($postId) . " not found."; // Сообщение, если пост не найден
            }
        } else {
            // Обработка ошибки запроса
            echo "Error when making a query to the database.";
            // Можно добавить логирование ошибки для отладки
            error_log("Error SQL: " . print_r($db->conn->errorInfo(), true)); // Более информативное логирование
        }
    } else {
        echo "The ID of the post to edit is not specified."; // Сообщение, если ID не указан
    }

    require_once VIEWS . '/components/footer.php'; // Подключаем подвал сайта
    ?>
</div>