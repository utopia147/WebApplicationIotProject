<?php

$statuson = $_POST['statuson'];
$statusoff = $_POST['statusoff'];
$channelid = $_POST['channelid'];


require "connect.php";

if ($statuson != null) {

  $sqlupdate = "UPDATE `settime` SET `stateOn`='$statuson' WHERE channelid = $channelid";
  $result1 = mysqli_query($con, $sqlupdate);
  if ($result1) {
    $response_result = "success";
    $success = "update qurry stateon";
    echo json_encode(array('response_result' => $response_result, 'success' => $success));
  } else {
    $response_result = "failed";
    $success = "failed update stateon";
    echo json_encode(array('response_result' => $response_result, 'success' => $success));
  }
  mysqli_close($con);
}
if ($statusoff != null) {

  $sqlupdate = "UPDATE `settime` SET `stateOff`='$statusoff' WHERE channelid = $channelid";
  $result1 = mysqli_query($con, $sqlupdate);
  if ($result1) {
    $response_result = "success";
    $success = "update qurry stateoff";
    echo json_encode(array('response_result' => $response_result, 'success' => $success));
  } else {
    $response_result = "failed";
    $success = "failed update stateoff";
    echo json_encode(array('response_result' => $response_result, 'success' => $success));
  }
  mysqli_close($con);
}
