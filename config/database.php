<?php
class Database{
    // Variable Declaration
    private $hostName;
    private $dbName;
    private $userName;
    private $password;
    private $conn;
    public function connect(){
    // Variable Initialization
        $this->hostName = "localhost";
        $this->dbName = "rest_php_api";
        $this->userName = "root";
        $this->password = "";

        $this->conn = new mysqli($this->hostName, $this->userName, $this->password, $this->dbName);
        if ($this->conn->connect_errno)
        {
            // true -> it means that it has some error
            print_r($this->conn->connect_errno);
            exit;
        }
        else
        {
            // false -> it means no error in connection details
            return $this->conn;
            //print_r($this->conn);
        }
    }
}

$db = new Database();
$db->connect();
?>