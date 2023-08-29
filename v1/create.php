<?php
    // Include database.php;
    include_once("../config/database.php");

    // Include student.php;
    include_once("../classes/student.php");

    // Create for object for database
    $db = new Database();
    $connection = $db->connect();

    // Create Object for student
    $student = new Student($connection);

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        // Submit data
        $student->name = "Sanjay";
        $student->email = "sanjay@gmail.com";
        $student->phone = "01625458564";
        if ($student->createData()) {
            echo "Student has been created";
        }else{
            echo "Failed to insert data.";
        }
    }else{
        echo "Access denied";
    }

