<?php
require "connect.php";
session_start();
if ($_POST['submit'] != null) {
    $channelid = $_POST['channelid'];
    $channelname = $_POST['channelname'];
    $descrip = $_POST['descrip'];
    $channelstatus = $_POST['channelstatus'];
    $userid = $_POST['userid'];
    $sql = "INSERT INTO `channel`(`channelid`,`userid`,`channelname`,`descrip`,`channelstatus`) VALUES ('$channelid','$userid','$channelname','$descrip','$channelstatus')";
    $result = mysqli_query($con, $sql);
}
if ($result == 1) {
    header("location:../viewchannel.php");
} else {
    echo "something wrong";
}
mysqli_close($con);
