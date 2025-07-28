<?
function dump($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}
function dd($data) {
    dump($data);
    die;
}
function abort($code = 404) {
    http_response_code($code);
    require_once VIEWS."/errors/{$code}.tmpl.php";
    die;
}
function loadRequestData(array $fillable = [], string $method = 'POST'){
    $data = [];
    if($method =='POST') {
        foreach($_POST as $field => $value) {
            if(in_array($field, $fillable)) {
                $data[$field] = trim($value);
            }
        } 
    }
    return $data;
}

function old(string $field_name) {
return isset($_POST[$field_name]) ? h(str: $_POST[$field_name]) : '';
}
function h($str) {
    return htmlspecialchars($str, flags: ENT_QUOTES);
}
function len($str) {
    return mb_strlen($str, 'UTF-8');
}
function getAlerts() {
    function getAlert($alert = 'info') {
    echo "<div class='alert alert-$alert alert-dismissible fade show' role='alert'>
    {$_SESSION[$alert]}
     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
}
    $alerts = [
    "success",
    "danger",
    "info",
    "warning",    
];

 if(!empty($_SESSION)) : ?>
 <div class="container">
   <? foreach($_SESSION as $key => $value):
        if(in_array($key, $alerts)):        
             getAlert($key);  
             unset($_SESSION[$key]);      
       endif;
    endforeach; ?>
     </div>
<? endif;
  
}

function redirect($uri = "") {
    dd($_SERVER["HTTP_REFERER"]);
    if($uri) {
        $redirect = $uri;
    }
    else {
        $redirect = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : PATH;
    }
    redirect("Location: {$redirect}");
    die;
}

