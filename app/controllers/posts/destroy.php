<?
global $db;

$data = (file_get_contents('php://input'));


$api_data = json_decode($data, true);
// dump($api_data); //NULL или json

$data = $api_data ?? $_POST;
$id = (int)$data['id'] ?? 0;

// dump($id);

$db->query("DELETE FROM posts WHERE post_id = ?", [$id]);


if($db->rowCount()) {
   $resp['response'] =  $_SESSION['success'] = "Post deleted";
   
} else {
    $resp['response'] = $_SESSION['danger'] = "Deletion error";
   
}
if($api_data) {
    echo json_encode($resp);
    die;
}

redirect(PATH);