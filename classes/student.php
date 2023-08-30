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

    //Read All Data from Database
    public function getAllData()
    {
        $query = "SELECT * from $this->tableName";
        $stuObj = $this->conn->prepare($query); // Prepare statement

        //Execute Query
        $stuObj->execute();

        return $stuObj->get_result();
    }

    // Read Single student data
    public function getSingleStudent()
    {
        $query = "SELECT * FROM $this->tableName WHERE id= ?";

        // Prepare statement
        $sinStuObj = $this->conn->prepare($query);
        $sinStuObj->bind_param('i', $this->id); // Bind parameter with the prepared statement
        $sinStuObj->execute();
        $data = $sinStuObj->get_result();
        return $data->fetch_assoc();
    }
}
?>