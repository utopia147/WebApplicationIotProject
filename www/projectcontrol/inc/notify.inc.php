<?php
require "connect.php";
date_default_timezone_set('asia/bangkok');
$strDate = date("Y-m-d H:i:s", mktime(date("H"), date("i") + 0, date("s") + 0, date("m") + 0, date("d") + 0, date("Y") + 0));
$notifyid = $_POST['notifyid'];
$notifyidstate = $_POST['notifyidstate'];
$notifystate = $_POST['notifystate'];
$notifytime = $_POST['notifytime'];
$userid = $_POST['userid'];

if ($notifystate != null) {
  if ($notifystate == 1) {
    $sqlupdate = "UPDATE `notify` SET `notifystate`=$notifystate,`notifytimestamp`='$strDate' WHERE notifyid = $notifyid";
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
  } else if ($notifystate == 0) {
    $sqlupdate = "UPDATE `notify` SET `notifystate`=$notifystate WHERE notifyid = $notifyid";
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
}
if (isset($notifytime)) {
  $sqlupdate = "UPDATE `notify` SET `notifytime`='$notifytime' WHERE notifyid = $notifyid";
  $result1 = mysqli_query($con, $sqlupdate);
  if ($result1) {
    echo ' <script type="text/javascript">
        window.location="../notify.php?userid=' . $userid . '";
        </script>';
  } else {
    echo "update failed";
  }
  mysqli_close($con);
}
