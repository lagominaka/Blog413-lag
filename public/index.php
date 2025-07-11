<?

define("ROOT", dirname(__DIR__));

define("PATH", "https://blog413.loc");

define("APP", ROOT . '/app');

define("VIEWS", APP . '/views');

define("CONTROLLERS", APP . '/controllers');

define("CONFIG", ROOT . '/config');

define("CORE", ROOT . '/core');

define("PUBLIC", ROOT . '/public');


require_once CORE.'/functions.php';

$uri = trim($_SERVER['REQUEST_URI'],'/');
// dd($uri);
if ($uri == '' || $uri == 'index.php' || $uri == 'index') {
    require_once CONTROLLERS.'/index.php';
}
else if ($uri == 'contacts.php') {
    require_once CONTROLLERS.'/contacts.php';
}
else {
   //404 
}