<?php

global $db;
require_once CLASSES . '\Validator.php';

$form_data = $_SESSION['form_data'] ?? [];
unset($_SESSION['form_data']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fillable = ['login', 'password', 'password_confirmation'];
    $data = loadRequestData($fillable);

    $rules = [
        'login' => ['required' => true, 'min' => 5, 'max' => 100],
        'password' => ['required' => true, 'validatePassword' => true],
        'password_confirmation' => ['match' => 'password'],
    ];

    $validator = new Validator();
    $validator->validate($data, $rules);

    if (!$validator->hasErrors()) {
        $login = $data['login'];
        $password = $data['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Обновляем пароль в базе данных.
        $sql = "UPDATE users SET password = ? WHERE login = ?";
        $result = $db->query($sql, [$hashedPassword, $login]);

        if ($result) {
            $_SESSION['success'] = "The password has been successfully changed!";
            redirect(PATH);
        } else {
            $_SESSION['warning'] = "An error occurred when updating the password!"; 
        }
    } else {
        $_SESSION['form_data'] = $data; // Сохраняем данные для отображения ошибок.
    }
}


require_once USERS_VIEWS . "/reset-password.tmpl.php";
?>
