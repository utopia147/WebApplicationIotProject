<?php

require "connect.php";
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT `userid`,`username`, `password`, `fname`, `lname`, `status` FROM `users` WHERE username='$username' AND password=('$password')";

$result = mysqli_query($con, $sql);
$rowcount = mysqli_num_rows($result);
if ($rowcount > 0) {
    $row = mysqli_fetch_array($result);
    $status = $row['status'];
    $_SESSION['username'] = $username;
    $_SESSION['userid'] = $row['userid'];
    $_SESSION['status'] = $row['status'];
    header("Location: ../indexuser.php");

    if ($status == 'R') {
        header("location: ../viewchannel.php");
    }
} else {
    header("location:../login.php");
}
