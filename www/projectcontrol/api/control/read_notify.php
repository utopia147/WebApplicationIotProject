<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Creating Array for JSON response
$response = array();

// Include data base connect class

require "../../inc/connect.php";

// Connecting to database


// Check if we got the field from the user


$sql = "SELECT * FROM notify WHERE 1";
$result = mysqli_query($con, $sql);

//If returned result is not empty
if (!empty($result)) {

    // Check for succesfull execution of query and no results found
    if (mysqli_num_rows($result) > 0) {

        // Storing the returned array in response
        while ($row = mysqli_fetch_assoc($result)) {
            $json1[] = $row;
        }
        $json = json_encode($json1, JSON_PRETTY_PRINT);
        echo $json;
        //var_dump($json);
        //$read = json_decode($json, true);
        //echo $read[2]['timesetOn'];
    } else {
        // If no data is found
        $response["success"] = 0;
        $response["message"] = "ไม่มีข้อมูลใน DB";

        // Show JSON response
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
} else {
    // If no data is found
    $response["success"] = 0;
    $response["message"] = "qurry ไม่พบข้อมูล";

    // Show JSON response
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
