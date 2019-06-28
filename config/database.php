<?php
class Database{
  
    // specify your own database credentials
    private $host = "localhost:3308";
    private $db_name = "sewkool_db";
    private $username = "root";
    private $password = "!A1a12345678";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>