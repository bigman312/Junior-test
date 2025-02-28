<?php
class Connection {
    private $servername = "localhost"; 
    private $username = "root";
    private $password = "";
    private $db = "product";
    public $conn;
    public $connected = false;

    public function getConnection(){
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->db", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connected = true;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>
