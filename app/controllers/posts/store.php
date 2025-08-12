<?
global $db;

require_once CLASSES . '\Validator.php';



$title = $header = "New Post";

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
        'email' => [
            'email' => true,
        ],
        'password' => [
            'required' => true,
            'min' => 6,
        ],
        'password_confirm' => [
            'match' => 'password',
        ],

    ];
    $validator = new Validator();
    $validator->validate($data, $rules);

    if (!$validator->hasErrors()) {
        
        $sql = "INSERT INTO `posts`(`title`, `slug`, `descr`, `content`) VALUES (?,?,?,?)";
        $data['slug'] = str_replace(" ", "-", $data['title']);

        if ($db->query($sql, [$data['title'], $data['slug'], $data['descr'], $data['content']])) {

            $_SESSION['success'] = "Post created";
            redirect(PATH);
        } else {
            $_SESSION['warning'] = "DB Error";
            redirect('');
        }
    }
}
require_once POSTS_VIEWS . "\create.tmpl.php";
