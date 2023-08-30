<?php
// Include Header
header("Access-Control-Allow-Origin: *"); //it allows all origin like localhost, any domain or any subdomain
header("Access-Control-Allow-Method: GET"); // Method types allow
// To Include database.php;
include_once("../config/database.php");

// Include student.php;
include_once("../classes/student.php");

// Create for object for database
$db = new Database();
$connection = $db->connect();

// Create Object for student
$student = new Student($connection);

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $studentId = isset($_GET['id']) ? $_GET['id'] : "";
    if (!empty($studentId)) {
        $student->id = $studentId;
        if ($student->deleteStudent()){
            http_response_code(200); // 200 means Ok
            echo json_encode(array(
                "status" => 1,
                "message" => "Student deleted successfully"
            ));
        }else{
            http_response_code(500); // 500 means service error
            echo json_encode(array(
                "status" => 0,
                "message" => "Failed to delete student"
            ));
        }
    }else{
        http_response_code(404); // 404 means data not found
        echo json_encode(array(
            "status" => 0,
            "message" => "All data needed"
        ));
    }

}else{
    http_response_code(503); // 503 means service unavailable
    echo json_encode(array(
        "status" => 0,
        "message" => "Access Denied"
    ));
}