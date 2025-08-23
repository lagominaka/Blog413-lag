<?php

global $db;
require_once CLASSES . '\Validator.php';

$form_data = $_SESSION['form_data'] ?? [];
unset($_SESSION['form_data']);

// Очищаем данные формы из сессии, чтобы не отображать их повторно.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fillable = ['login', 'password'];
    $data = loadRequestData($fillable);

    $rules = [

        'login' => [
            'required' => true,
            'min' => 5,
            'max' => 100,

        ],
        'password' => [
            'required' => true,
            'validatePassword' => true, 
        ],
        'password_confirmation' => [
            'match' => 'password',
        ],
    ];

    $validator = new Validator();
    $validator->validate($data, $rules);
   
    if (!$validator->hasErrors()) {
        $username = $data['login']; // Получаем имя пользователя.
        $password = $data['password'];// Получаем пароль.

    $sql = "SELECT login, password FROM users WHERE login = ?";
    $stmt = $db->query($sql, [$username])->find();
     


            if ($stmt) {

              if (password_verify($password, $stmt['password'])) {
                 $_SESSION['success'] = "You have successfully replicated!";
                 redirect(PATH);
                 exit;
             } else {
                  $_SESSION['warning'] = "Incorrect password!";
                   $_SESSION['form_data']['login'] = $data['login'];
                   redirect('');
             }
            } else {
                $_SESSION['warning'] = "There is no such user! Register!";
                redirect('/users/create');
         } 
    } else {
        // Сохраняем данные формы (включая логин) в сессии для отображения в форме, если есть ошибки валидации
        $_SESSION['form_data'] = $data;
  
   }  
}
require_once USERS_VIEWS . "/login.tmpl.php";

?>