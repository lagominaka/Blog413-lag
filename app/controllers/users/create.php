<?
global $db;

require_once CLASSES . '\Validator.php';

// Получаем данные формы из сессии (если есть) и сразу удаляем их
$form_data = $_SESSION['form_data'] ?? [];
unset($_SESSION['form_data']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fillable = ['login', 'email', 'password', 'password_confirmation'];
    $data = loadRequestData($fillable);

    $rules = [
        'login' => [
            'required' => true,
            'min' => 5,
            'max' => 100,

        ],
        'email' => [
            'required' => true,
            'email' => true,

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
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        // Проверяем, существует ли пользователь с таким логином или email
        $sql = "SELECT login, email FROM users WHERE login = ? OR email = ?";
        $stmt = $db->query($sql, [$data['login'], $data['email']])->find();

        if ($stmt) {
            $error_message = ""; // Сообщение об ошибке

            if ($stmt['login'] == $data['login']) {
                $error_message .= "The user with this username already exists. ";
                $data['login'] = '';//очищаем поле логина
            }

            if ($stmt['email'] == $data['email']) {
                $error_message .= "The user with this address already exists.";
                $data['email'] = ''; //очищаем поле email
            }

            $_SESSION['warning'] = $error_message; // Сохраняем сообщение об ошибке в сессии
            $_SESSION['form_data'] = $data; // Сохраняем данные формы в сессии
            redirect(''); // Перенаправляем пользователя обратно на форму
            // exit();
        } else { // Если логин и email свободны
            $sql = "INSERT INTO `users`(`login`, `email`, `password`) VALUES (?,?,?)";

            if ($db->query($sql, [$data['login'], $data['email'], $hashedPassword])) {
                $_SESSION['success'] = "Registration was successful!";
                redirect(PATH);
                // exit();
            } else {
                $_SESSION['warning'] = "DB Error";
                redirect('');
                // exit();
            }
        }
    }

// Получаем данные формы из сессии (если есть)
$form_data = $_SESSION['form_data'] ?? [];
}
require_once USERS_VIEWS . "/register.tmpl.php";
