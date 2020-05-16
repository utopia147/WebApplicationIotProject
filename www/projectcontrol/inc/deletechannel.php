<?php

require "connect.php";

$id = $_GET['id'];

$sqlControl = "DELETE FROM `control` WHERE controlid = $id";
$resultControl = mysqli_query($con, $sqlControl);
if ($resultControl) {

    $sqlDevice = "DELETE FROM `channel` WHERE channelid = $id";
    $resultDevice = mysqli_query($con, $sqlDevice);
    if ($resultDevice) {
        echo ' <script type="text/javascript">
        window.location="../viewchannel.php";
        </script>';
    }
}
mysqli_close($con);
