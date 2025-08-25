<?

class DB
{
   private $conn;
   private PDOStatement $stmt;
   private static $instance = null; //был ли уже создан экземпляр класса DB

   // сокрытие методов, способных создавать новые экземпляры класса DB
   private function __construct() {}
   // private function __clone() {}
   // private function __wakeup() {}


   public function getConnection(array $db_config)
   {
      $dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";
      try {
         $this->conn = new PDO($dsn, $db_config['username'], $db_config['password'], $db_config['options']);
         return $this;
      } catch (PDOException $e) {
         abort(500);
      }
   }

   //получение экземпляра класса DB
   public static function getInstance()
   {
      if (self::$instance === null) {
         self::$instance = new self(); //новый экземпляр класса DB
      }
      return self::$instance;
   }

   public function query($sql, $params = [])
   {
      try {
         $this->stmt = $this->conn->prepare($sql);
         $this->stmt->execute($params);
      } catch (PDOException $e) {
         return false;
      }
      return $this;
   }


   function findAll()
   {
      return $this->stmt->fetchAll();
   }

   function find()
   {
      return $this->stmt->fetch();
   }

   function findOrAbort()
   {
      $result = $this->find();
      if (!$result) {
         abort();
      }
      return $result;
      }
   
  function rowCount() {
   return $this ->stmt->rowCount();
  }
   public function getColumn()
   {
      return $this->stmt->fetchColumn();
   }
}