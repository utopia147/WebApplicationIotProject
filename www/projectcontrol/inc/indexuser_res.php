<?php
require "connect.php";
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
date_default_timezone_set('asia/bangkok');
$strDate = date("Y-m-d H:i:s", mktime(date("H"), date("i") + 0, date("s") + 0, date("m") + 0, date("d") + 0, date("Y") + 0));

$sqlShowNodemcu = "SELECT * FROM `nodemcu` WHERE 1";
$resultShowNodemcu = mysqli_query($con, $sqlShowNodemcu);
if (!$resultShowNodemcu) {
    echo "Nodemcu qurry failed";
}

$rowNode = mysqli_fetch_assoc($resultShowNodemcu);
$alive = $rowNode['alive'];
$statusNode = $rowNode['statusNode'];
$node_datetime = $rowNode['node_datetime'];


//echo  'Date connected NodeMCU' . $node_datetime;
//echo '<br>Current time' . $strDate;

$NodemcuConnected = new DateTime($node_datetime);
$DateDiff = $NodemcuConnected->diff(new DateTime($strDate));
$NodemcuLastestConnectedY = $DateDiff->y;
$NodemcuLastestConnectedM = $DateDiff->m;
$NodemcuLastestConnectedD = $DateDiff->d;
$NodemcuLastestConnectedH = $DateDiff->h;
$NodemcuLastestConnectedMin = $DateDiff->i;
$NodemcuLastestConnectedS = $DateDiff->s;
$NodeLastestOnline  = sprintf("เชื่อมต่อล่าสุดเมื่อ %01dปี %01dเดือน %01dวัน %02dชั่วโมง %02dนาที %02dนาที ที่ผ่านมา", $NodemcuLastestConnectedY, $NodemcuLastestConnectedM, $NodemcuLastestConnectedD, $NodemcuLastestConnectedH, $NodemcuLastestConnectedMin, $NodemcuLastestConnectedS);
//echo $NodeLastestOnline;
//$NodeLastestOnline  = $NodemcuLastestConnectedY . "ปี " . $NodemcuLastestConnectedM . "เดือน " . $NodemcuLastestConnectedD . "วัน " . $NodemcuLastestConnectedH . "ชั่วโมง " . $NodemcuLastestConnectedMin . "นาที " . $NodemcuLastestConnectedS . "วินาที";
$TimeOut = 31 - $NodemcuLastestConnectedS;
$NodeTimeOut = sprintf("%02d วินาที", $TimeOut);
//echo "NodeMCU Connected Lastest: " . $NodemcuLastestConnectedY . "y" . $NodemcuLastestConnectedM . "mo" . $NodemcuLastestConnectedD . "d" . $NodemcuLastestConnectedH . "h" . $NodemcuLastestConnectedMin . "m" . $NodemcuLastestConnectedS . "s"; //0y0m0d0h19m55s
//$outputConnected .= "<link href='css/bootstrap-toggle.min.css' rel='stylesheet'>
//<script src='https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js'></script>";
if ($NodemcuLastestConnectedY == 0 && $NodemcuLastestConnectedM == 0 && $NodemcuLastestConnectedD == 0 && $NodemcuLastestConnectedH == 0 && $NodemcuLastestConnectedMin == 0 && $NodemcuLastestConnectedS <= 1) {
    $ObjNode->NodeStatus = "Connected";
    $ObjNode->alive = $alive;
    $ObjNode->statusNode = $statusNode;
    $jsonNode = json_encode($ObjNode);
    echo $jsonNode;


    //echo "<br>NodeMCU Connected";


} else if ($NodemcuLastestConnectedY == 0 && $NodemcuLastestConnectedM == 0 && $NodemcuLastestConnectedD == 0 && $NodemcuLastestConnectedH == 0 && $NodemcuLastestConnectedMin == 0 && $NodemcuLastestConnectedS <= 31) {
    //echo "<br>NodeMCU Timeout ";

    $ObjNode->NodeStatus = "Connection Timeout";
    $ObjNode->alive = $alive;
    $ObjNode->statusNode = $statusNode;
    $ObjNode->NodeTimeOut = $NodeTimeOut;
    $jsonNode = json_encode($ObjNode);
    echo $jsonNode;
} else {
    $ObjNode->NodeStatus = "Disconnected";
    $ObjNode->alive = $alive;
    $ObjNode->statusNode = $statusNode;
    $ObjNode->NodeLastestOnline = $NodeLastestOnline;
    $jsonNode = json_encode($ObjNode, JSON_UNESCAPED_UNICODE);
    echo $jsonNode;
    //echo "<br>NodeMCU Disconnected";

}
