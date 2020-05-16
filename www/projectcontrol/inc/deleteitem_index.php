<?php

require "connect.php";

$id = $_GET['id'];

$sqlitem = "DELETE FROM `item` WHERE itemid = $id";
$resultitem = mysqli_query($con, $sqlitem);
if ($resultitem) {
    echo 'done';
}
mysqli_close($con);
