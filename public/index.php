<?
session_start();

require_once dirname(__DIR__) . '/config/config.php';
require_once CORE . '/functions.php';

require_once CLASSES . "/DB.php";
require_once CLASSES . "/Router.php";
$db_config = require_once CONFIG . '/db.php';
// $db = new DB($db_config);
// dd($db);
$db = DB::getInstance()->getConnection($db_config);


$router = new Router();
require_once CONFIG."/routes.php";

$router->match();
