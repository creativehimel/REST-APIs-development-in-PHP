<?php
    // Include Header
    header("Access-Control-Allow-Origin: *"); //it allows all origin like localhost, any domain or any subdomain
    header("Content-type: application/json charset = UTF-8"); //Data which we are getting inside request
    header("Access-Control-Allow-Method: POST"); // Method types allow
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
        $data = json_decode(file_get_contents("php://input"));
        if (!empty($data->name) && !empty($data->email) && !empty($data->phone)) {
            // Submit data
            $student->name = $data->name;
            $student->email = $data->email;
            $student->phone = $data->phone;
            if ($student->createData()) {
                http_response_code(200); // 200 means Ok
                echo json_encode(array(
                    "status" => 1,
                    "message" => "Student has been created"
                ));
            }else{
                http_response_code(500); // 500 means internal server error
                echo json_encode(array(
                    "status" => 0,
                    "message" => "Failed to created student"
                ));
            }
        }else{
            http_response_code(404); // 404 means page not found
            echo json_encode(array(
                "status" => 0,
                "message" => "All Values needed"
            ));
        }
    }else{
        http_response_code(503); // 500 means service unavailable
        echo json_encode(array(
            "status" => 0,
            "message" => "Access denied"
        ));
    }

