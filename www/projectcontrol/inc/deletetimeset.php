<?php

require "connect.php";

$id = $_GET['id'];

$sqlitem = "DELETE FROM `settime` WHERE timeid = $id";
$resultitem = mysqli_query($con, $sqlitem);
if ($resultitem) {
    echo ' <script type="text/javascript">
        window.location="../viewsettime.php";
        </script>';
}
mysqli_close($con);
