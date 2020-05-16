<?php
require "connect.php";

$statuslog = $_POST['statuslog'];
$channelid = $_POST['channelid'];
$fullname = $_POST['fullname'];

$sqlLinenotify =  "SELECT * FROM notify WHERE 1";
$resultLinenotify = mysqli_query($con, $sqlLinenotify);

$rowLinenotify = mysqli_fetch_assoc($resultLinenotify);


$StateNotify = $rowLinenotify['notifystate'];


// echo $StateNotify . ' ' . $LineToken;
if ($StateNotify == "1") {
    $LineToken = $rowLinenotify['linetoken'];
    $msg = 'คุณ ' . $fullname . ' ได้ทำการ ' . $statuslog . ' Relay แชลแนลที่ ' . $channelid . ' !';


    // echo json_encode(array('response_result' => $msg), JSON_UNESCAPED_UNICODE);
    function send_line_notify($message, $token)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "message=$message");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $headers = array("Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token",);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
    echo send_line_notify($msg, $LineToken);
}
