<?php
    // Include Header
    header("Access-Control-Allow-Origin: *"); //it allows all origin like localhost, any domain or any subdomain
    header("Access-Control-Allow-Method: GET"); // Method types allow
    // Include database.php;
    include_once("../config/database.php");

    // Include student.php;
    include_once("../classes/student.php");

    // Create for object for database
    $db = new Database();
    $connection = $db->connect();

    // Create Object for student
    $student = new Student($connection);

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $data = $student->getAllData();
    if ($data->num_rows > 0) {
        //we have some data inside table
        $students["records"] = array();
        while ($row = $data->fetch_assoc()) {
            array_push($students["records"], array(
                "id" => $row['id'],
                "name" => $row['name'],
                "email" => $row['email'],
                "phone" => $row['phone'],
                "status" => $row['status'],
                "created_at" => date("Y-m-d", strtotime($row['created_at']))
            ));
        }
        http_response_code(200); // 200 means ok status
        echo json_encode(array(
            "status" => 1,
            "data" => $students["records"]
        ));
    }
}else{
    http_response_code(503); // 503 means service unavailable
    echo json_encode(array(
        "status" => 0,
        "message" => "Access Denied"
    ));
}


