<?php
require "connect.php";
session_start();
if ($_POST['submit'] != null) {
    $channelid = $_POST['channelid'];
    $itemname = $_POST['itemname'];

    $sql = "INSERT INTO `item`(`channelid`,`itemname`) VALUES ('$channelid','$itemname')";
    $result = mysqli_query($con, $sql);
}
if ($result == 1) {
    header("location:../viewitem.php");
} else {
    echo "something wrong";
}
mysqli_close($con);
