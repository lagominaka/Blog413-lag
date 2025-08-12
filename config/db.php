<?

return [
   'host' => 'MySQL-8.2',
   'dbname' => 'BLOG',
   'username' => 'root',
   'password' => '',
   'charset' => 'utf8',
   'options' => [
      //PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
   ]
];
