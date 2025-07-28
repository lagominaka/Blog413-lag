<?
require_once CLASSES.'\Validator.php';

$title = $header = "New Post";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $title = $_POST['title'];
    // $descr = $_POST['descr'];
    // $content = $_POST['content'];

    $fillable = ['title', 'descr', 'content'];
    // $errors =[];//ошибки валидации
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
        ]
    ];

    $validator = new Validator();
    $validator->validate($data,$rules);
    // $errors = $validator->getErrors();
    // if($validator->hasErrors()) {
    // dd($errors);



    if(!$validator->hasErrors()) {
        $sql = "INSERT INTO `posts`(`title`, `slug`, `descr`, `content`) VALUES (?,?,?,?)";
        $data['slug'] = str_replace(" ", "-", $data['title']);

        if($db->query($sql, [$data['title'], $data['slug'], $data['descr'], $data['content']])) {
 
            $_SESSION['success'] = "Post created";
            // redirect(uri: PATH);
        }
        else {
            $_SESSION['warning'] = "DB Error";
        }
             
    }
 
}

require_once POSTS_VIEWS.'\create.tmpl.php';