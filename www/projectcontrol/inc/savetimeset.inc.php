<?php
require "connect.php";
session_start();
if ($_POST['submit'] != null) {
    $channelid = $_POST['channelid'];
    $timesetOn = $_POST['timesetOn'];
    $timesetOff = $_POST['timesetOff'];
    $stateOn = $_POST['stateOn'];
    $stateOff = $_POST['stateOff'];
    $sql = "INSERT INTO `settime`(`channelid`,`stateOn`,`stateOff`,`timesetOn`,`timesetOff`) 
    VALUES ('$channelid','$stateOn','$stateOff','$timesetOn','$timesetOff')";
    $result = mysqli_query($con, $sql);
}
if ($result == 1) {
    header("location:../viewsettime.php");
} else {
    echo "something wrong";
}
mysqli_close($con);
