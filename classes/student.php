<?php
class Student{
    // Declare Variable
    public $name;
    public $email;
    public $phone;
    private $conn;
    private $tableName;

    // Constructor
    public function __construct($db)
    {
        $this->conn = $db;
        $this->tableName = "students";
    }

    public function createData()
    {
        // SQL query to insert data
        $query = "INSERT INTO $this->tableName (name, email, phone) VALUES (?,?,?)";

        //Prepare the SQL
        $obj = $this->conn->prepare($query);

        //sanitize input variable -> basically removes the extra characters like some special symbol as well as if some tags available in input values
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));

        //Binding parameters with prepare statement
        $obj->bind_param("sss", $this->name, $this->email, $this->phone);

        //Executing Query
        if ($obj->execute()) {
            return true;
        }
        return false;
    }
}
?>