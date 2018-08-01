<?php
namespace Module\Quiz\Model\Util;
    
    use \PDO;
    use \PDOException;
    
    class Conection
    {
        /**
         * Get a new connection on instantiate the class.
         */
        function __construct()
        {
            $this->Connect();
        }
        
        /**
         * On destroy the class, disconnect from the database.
         */
        function __destruct()
        {
            $this->Disconnect();
            foreach ($this as $key => $value) {
                unset($this->$key);
            }
        }
        
        /**
         * It maintains a unique instance of the PDO class that connects to the database.
         * Design Pattern: Singleton.
         * 
         * @var PDO $conection.
         */
        public static $conection;
        
        /**
         * Variables to connect to the database.
         * Could be constants.
         * @var string
         */
        private static $DB_TYPE = 'mysql';
        private static $DB_HOST = 'localhost';
        private static $DB_PORT = '3306';
        private static $DB_USER = 'root';
        private static $DB_PASS = '1234';
        private static $DB_NAME = 'QUIZ_DB';
        private static $DB_CHRS = 'utf8mb4';
        
        /**
         * Create a new instance of the PDO class to connect to the Database.
         * @return PDO
         */
        public static function Connect() : PDO
        {
            if (!isset(self::$conection)) {
                self::$conection = new PDO(
                        
                self::$DB_TYPE.":host=".self::$DB_HOST.";port=".self::$DB_PORT.";dbname=".self::$DB_NAME.";charset=".self::$DB_CHRS, self::$DB_USER, self::$DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));
                
                self::$conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            
            return self::$conection;
        }
        
        /**
         * Arrow to zero the connection to the PDO database.
         */
        public function Disconnect() : void
        {
            self::$conection = null;
        }
    }
 
