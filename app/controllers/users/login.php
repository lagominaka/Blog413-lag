<?php

global $db;


// Очищаем данные формы из сессии, чтобы не отображать их повторно.
unset($_SESSION['form_data']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fillable = ['login', 'password'];
    $data = loadRequestData($fillable);

    // Валидация данных (пример)
    $username = $data['login'] ?? ''; // Получаем логин, задаем пустую строку, если он отсутствует
    $password = $data['password'] ?? ''; // Получаем пароль, задаем пустую строку, если он отсутствует

    $sql = "SELECT login, password FROM users WHERE login = ? OR password = ?";
    $stmt = $db->query($sql, [$data['login'], $data['password']])->find();

    // dd($stmt); // Вывод для отладки

    // Проверяем, найден ли пользователь и совпадает ли пароль
    if ($stmt && password_verify($password, $stmt['password'])) {
        // Успешная авторизация
        $_SESSION['success'] = "You have successfully replicated!";
        redirect(PATH);
        exit;
    } else {
        $_SESSION['warning'] = "There is no such user! Register!";
        redirect(PATH);
    }
}
require_once USERS_VIEWS . "/login.tmpl.php";

?>