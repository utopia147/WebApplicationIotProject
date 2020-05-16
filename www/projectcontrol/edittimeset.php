<?php

require "head.php";
require "inc/connect.php";

if ($_POST['submit'] != null) {
    $channelid = $_POST['channelid'];
    $timeid = $_POST['timeid'];
    $timesetOn = $_POST['timesetOn'];
    $timesetOff = $_POST['timesetOff'];
    $stateOn = $_POST['stateOn'];
    $stateOff = $_POST['stateOff'];

    $sql = "UPDATE `settime` SET`stateOn`='$stateOn',`stateOff`='$stateOff', `timesetOn`='$timesetOn',`timesetOff`='$timesetOff',`channelid`='$channelid'
     WHERE timeid=$timeid";
    $result = mysqli_query($con, $sql);
    if ($result == 1) {
        echo ' <script type="text/javascript">
            window.location="viewsettime.php";
            </script>';
    }
    //header("Location: controldevice.php");

    mysqli_close($con);
} else if ($_GET['id'] != null) {
    $id = $_GET['id'];
    $sql = "SELECT `timeid`, `channelid`, `stateOn`, `stateOff`,`timesetOn`, `timesetOff` 
    FROM `settime` WHERE timeid=$id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $row = mysqli_fetch_array($result);

        $ichannelid = $row['channelid'];
        $timeid = $row['timeid'];
        $itimesetOn = $row['timesetOn'];
        $itimesetOff = $row['timesetOff'];
        $istateOn = $row['stateOn'];
        $istateOff = $row['stateOff'];
    }
}

$sql1 = "SELECT `channelid` FROM `channel`";
$result1 = mysqli_query($con, $sql1);

?>

<link rel="stylesheet" href="css/stylecontent.css">
<div class="container">
    <div class="box1">
        <form class="form1" method="post" action="" enctype="multipart/form-data">
            <table width="600" border="0" cellspacing="1" cellpadding="1" align="center" class="table1">
                <tr>
                    <td height="50" align="center">
                        <h3>แก้ไข Channel</h3>
                    </td>
                </tr>
            </table>
            <table width="600" border="0" cellspacing="1" cellpadding="1" align="center">
                <tr>
                    <td width="200" align="right">TIME ID</td>
                    <td width="10" align="center">:</td>
                    <td><input name="timeid" type="text" size="2" value="<?php echo $timeid; ?>" readonly></td>
                <tr>
                    <td width="200" align="right">Channel ID</td>
                    <td width="10" align="center">:</td>
                    <td><select class="form-control" name="channelid">
                            <?php
                            if ($result1) {
                                while ($row1 = mysqli_fetch_array($result1)) {
                                    $channelid = $row1["channelid"];
                                    ?>
                                    <option value="<?php echo $channelid; ?>" <?php if ($ichannelid == $channelid) {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>แชลแนลที่ <?php echo $channelid; ?></option>
                            <?php
                                }
                            }
                            mysqli_close($con);
                            ?>
                        </select> </td>
                </tr>
                <tr>
                    <td width="200" align="right">State ON</td>
                    <td width="10" align="center">:</td>
                    <td><select class="form-control" name="stateOn">
                            <option value="1" <?php if ($istateOn == "1") {
                                                    echo "selected=\" selected\"";
                                                } ?>>เปิดการใช้งาน</option>
                            <option value="0" <?php if ($istateOn == "0") {
                                                    echo "selected=\" selected\"";
                                                } ?>>ปิดการใช้งาน</option>
                        </select></td>
                </tr>
                <tr>
                    <td width="200" align="right">เวลาเปิดอุปกรณ์</td>
                    <td width="10" align="center">:</td>
                    <td><input name="timesetOn" type="text" size="30" value="<?php echo $itimesetOn; ?>"></td>
                </tr>
                <tr>
                    <td width="200" align="right">State OFF</td>
                    <td width="10" align="center">:</td>
                    <td><select class="form-control" name="stateOff">
                            <option value="1" <?php if ($istateOff == "1") {
                                                    echo "selected=\" selected\"";
                                                } ?>>เปิดการใช้งาน</option>
                            <option value="0" <?php if ($istateOff == "0") {
                                                    echo "selected=\" selected\"";
                                                } ?>>ปิดการใช้งาน</option>
                        </select></td>
                </tr>
                <tr>
                    <td width="200" align="right">เวลาปิดอุปกรณ์</td>
                    <td width="10" align="center">:</td>
                    <td><input name="timesetOff" type="text" size="30" value="<?php echo $itimesetOff; ?>"></td>
                </tr>
                <td height="50" align="right">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td><button class="btn btn-warning" type="submit" name="submit" value="submit">แก้ไข</button></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

require "footer.php";
?>