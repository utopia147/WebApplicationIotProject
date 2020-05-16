<?php
require "connect.php";
session_start();
if ($_POST['submit'] != null) {
    $userid = $_POST['userid'];
    $linetoken = $_POST['linetoken'];
    $notifytime = $_POST['notifytime'];
    $notifystate = $_POST['notifystate'];

    $sql = "INSERT INTO `notify`(`userid`,`linetoken`,`notifytime`,`notifystate`)
     VALUES ('$userid','$linetoken','$notifytime','$notifystate')";
    $result = mysqli_query($con, $sql);
}
if ($result == 1) {
    echo ' <script type="text/javascript">
    window.location="../viewnotify.php";
    </script>';
} else {
    echo "something wrong";
}
mysqli_close($con);
