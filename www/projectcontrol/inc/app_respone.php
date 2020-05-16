<?php

require "connect.php";
$alive = $_POST['alive'];
$AppSayHiToNode = $_POST['AppSayHiToNode'];
if ($alive != NULL || $AppSayHiToNode != NULL) {

    $sqlUpdateNodeMcu = "UPDATE `nodemcu` SET `alive`='$alive',`statusNode`='$AppSayHiToNode'  WHERE id = 1";
    $resultUpdateNode = mysqli_query($con, $sqlUpdateNodeMcu);
    if ($resultUpdateNode) {
        $response_resultNode = "success";
        $successRes = "updated";
    } else {
        $response_resultNode = "Failed";
        $successRes = "Cannot updated Alive";
    }
    echo json_encode(array('response_result' =>  $response_resultNode, 'success' => $successRes));
    mysqli_close($con);
}
