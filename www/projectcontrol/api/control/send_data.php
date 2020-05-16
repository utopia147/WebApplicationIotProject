<?php
date_default_timezone_set('asia/bangkok');
$strDate = date("Y-m-d H:i:s", mktime(date("H"), date("i") + 0, date("s") + 0, date("m") + 0, date("d") + 0, date("Y") + 0));
$content = file_get_contents("php://input");
$datas = json_decode($content, true);


$channelid = $datas["channelid"];
$status = $datas["status"];
$NodeSayHi = $datas["NodeSayHi"];
$alive = $datas["alive"];


require "../../inc/connect.php";


if ($channelid && $status != NULL) {
  $sqlupdate = "UPDATE `channel` SET `status`='$status' WHERE channelid = $channelid";
  $result1 = mysqli_query($con, $sqlupdate);
  if ($result1) {
    $sqlRefesh = "UPDATE `nodemcu` SET `alive`='$alive' WHERE 1 ";
    $resultRefesh = mysqli_query($con, $sqlRefesh);
    $sqlinsert = "INSERT INTO `control` (`channelid`, `statusdevice`) VALUES ($channelid,'$statuslog')";
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
    $response_result = "Failed";
    $success = "Cannot Set Time updated qurry";
  }
  echo json_encode(array('response_result' => $response_result, 'success' => $success));
  mysqli_close($con);
}
if ($NodeSayHi != NULL) {
  $sqlUpdateNodeMcu = "UPDATE `nodemcu` SET `statusNode`='$NodeSayHi' , `node_datetime`='$strDate'  WHERE id = 1";
  $resultUpdateNode = mysqli_query($con, $sqlUpdateNodeMcu);
  if ($resultUpdateNode) {
    $response_resultNode = "success";
    $successRes = "updated statusNode";
  } else {
    $response_resultNode = "Failed";
    $successRes = "Cannot updated statusNode";
  }
  echo json_encode(array('response_result' =>  $response_resultNode, 'success' => $successRes));
  mysqli_close($con);
}
