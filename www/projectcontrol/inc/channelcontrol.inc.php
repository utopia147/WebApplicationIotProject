<?php
$statuslog = $_POST['statuslog'];
$status = $_POST['status'];
$channelid = $_POST['channelid'];
$mode = "กดปุ่ม";
$userid = $_POST['userid'];

require "connect.php";



$sqlupdate = "UPDATE `channel` SET `status`='$status' WHERE channelid = $channelid";
$result1 = mysqli_query($con, $sqlupdate);
if ($result1) {
  $sqlinsert = "INSERT INTO `control` (`channelid`, `userid`, `mode`, `statusdevice`) VALUES ($channelid,$userid,'$mode','$statuslog')";
  $result2 = mysqli_query($con, $sqlinsert);
  if ($result2) {
    $response_result = "success";
    $success = "insert qurry";
    echo json_encode(array('response_result' => $response_result, 'success' => $success));
  } else {
    $response_result = "failed";
    $success = "failed insert";
    echo json_encode(array('response_result' => $response_result, 'success' => $success));
  }
} else {
  $response_result = "failed";
  $success = "failed update";
  echo json_encode(array('response_result' => $response_result, 'success' => $success));
}
mysqli_close($con);
