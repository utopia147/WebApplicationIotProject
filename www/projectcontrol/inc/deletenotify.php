<?php

require "connect.php";

$id = $_GET['id'];

$sqlitem = "DELETE FROM `notify` WHERE notifyid = $id";
$result = mysqli_query($con, $sqlitem);
if ($result) {
    echo ' <script type="text/javascript">
        window.location="../viewnotify.php";
        </script>';
}
mysqli_close($con);
