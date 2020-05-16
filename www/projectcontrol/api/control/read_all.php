<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Creating Array for JSON response
$response = array();

// Include data base connect class

require "../../inc/connect.php";

// Connecting to database


// Check if we got the field from the user
if (isset($_GET["id"])) {
    $id = $_GET['id'];

    $sql = "SELECT *FROM channel WHERE channelid = '$id' ";
    $result = mysqli_query($con, $sql);

    //If returned result is not empty
    if (!empty($result)) {

        // Check for succesfull execution of query and no results found
        if (mysqli_num_rows($result) > 0) {

            // Storing the returned array in response
            $row = mysqli_fetch_array($result);

            // temperoary user array
            $channel = array();
            $channel["channelid"] = $row["channelid"];
            $channel["status"] = $row["status"];

            $response["success"] = 1;

            $response["channel"] = array();

            // Push all the items 
            array_push($response["channel"], $channel);

            // Show JSON response
            echo json_encode($response);
        } else {
            // If no data is found
            $response["success"] = 0;
            $response["message"] = "ไม่พบข้อมูล";

            // Show JSON response
            echo json_encode($responseม, JSON_UNESCAPED_UNICODE);
        }
    } else {
        // If no data is found
        $response["success"] = 0;
        $response["message"] = "ไม่พบข้อมูล";

        // Show JSON response
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
} else {
    // If required parameter is missing
    $response["success"] = 0;
    $response["message"] = "ไม่มีการส่งค่าตัวแปรมา";

    // echoing JSON response
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
