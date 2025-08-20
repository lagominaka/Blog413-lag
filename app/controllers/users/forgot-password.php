<?php

global $db;
require_once CLASSES . '\Validator.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST["email"]);
  dd($email);

  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {


    $sql = "SELECT id FROM users WHERE email = :email";
    $params = [':email' => $email];
    $db->query($sql, $params);

    if ($db->rowCount() == 1) {
      $userId = $db->find()['id']; // Получаем ID пользователя
      dd($userId);
    }
}
}
require_once USERS_VIEWS . "/forgot-password.tmpl.php";
