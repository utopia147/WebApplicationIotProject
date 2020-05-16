<?php
session_start();
require "connect.php";

$username = $_POST['username'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$status = $_POST['status'];
$picture = $_FILES['picture']['name'];
$target_dir = '../upload/pic/';
$target_file = $target_dir . basename($_FILES["picture"]["name"]);
if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
    echo 'sucess';
}
$sql = "INSERT INTO `users`(`username`, `password`, `fname`, `lname`, `email`, `picture`, `status`) 
VALUES ('$username','$password','$firstname','$lastname','$email','$picture','$status')";
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
