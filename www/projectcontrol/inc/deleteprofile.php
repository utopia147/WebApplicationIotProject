<?php
session_start();
require "connect.php";

$id = $_GET['id'];

$sql = "DELETE FROM `users` WHERE userid = $id";
$result = mysqli_query($con, $sql);
if ($result) {
    if ($_SESSION['status'] == 'R') {
        echo ' <script type="text/javascript">
            window.location="../viewuserall.php";
            </script>';
    } else {
        echo ' <script type="text/javascript">
        window.location="../viewuser.php";
        </script>';
    }
}
