<?php

require "head.php";
require "inc/connect.php";

if ($_POST['submit'] != null) {
    $notifyid = $_POST['notifyid'];
    $userid = $_POST['userid'];
    $linetoken = $_POST['linetoken'];
    $notifytime = $_POST['notifytime'];
    $notifystate = $_POST['notifystate'];

    $sql = "UPDATE `notify` 
    SET `userid`='$userid',`linetoken`='$linetoken'
    ,`notifytime`='$notifytime',`notifystate`='$notifystate'
     WHERE notifyid = $notifyid";
    $result = mysqli_query($con, $sql);
    if ($result == 1) {
        echo ' <script type="text/javascript">
            window.location="viewnotify.php";
            </script>';
    }
    //header("Location: controldevice.php");

    mysqli_close($con);
} else if ($_GET['id'] != null) {
    $id = $_GET['id'];
    $sql = "SELECT `notifyid`, `userid`, `linetoken`, `notifytime`, `notifystate` 
    FROM `notify` WHERE notifyid=$id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $row = mysqli_fetch_array($result);

        $inotifyid = $row['notifyid'];
        $iuserid = $row['userid'];
        $ilinetoken = $row['linetoken'];
        $inotifytime = $row['notifytime'];
        $inotifystate = $row['notifystate'];
    }
}




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
                    <td width="200" align="right">Notify ID</td>
                    <td width="10" align="center">:</td>
                    <td><input name="notifyid" type="text" size="2" value="<?php echo $inotifyid; ?>" readonly></td>
                <tr>
                    <td width="200" align="right">User ID</td>
                    <td width="10" align="center">:</td>
                    <td><input name="userid" type="text" size="2" value="<?php echo $iuserid; ?>" readonly></td>
                </tr>
                <tr>
                    <td width="200" align="right">Line Token</td>
                    <td width="10" align="center">:</td>
                    <td><input name="linetoken" type="text" size="30" value="<?php echo $ilinetoken; ?>"></td>
                </tr>
                <tr>
                    <td width="200" align="right">เวลาแจ้งรายงาน</td>
                    <td width="10" align="center">:</td>
                    <td><select class="custom-select" id="inputGroupSelect02" name="notifytime">
                            <option value="3600000">แจ้งเตือนทุกๆ 1 ชั่วโมง</option>
                            <option value="10800000">แจ้งเตือนทุกๆ 3 ชั่วโมง</option>
                            <option value="21600000">แจ้งเตือนทุกๆ 6 ชั่วโมง</option>
                            <option value="43200000">แจ้งเตือนทุกๆ 12 ชั่วโมง</option>
                            <option value="86400000">แจ้งเตือนทุกๆ 24 ชั่วโมง</option>
                        </select></td>
                </tr>
                <tr>
                    <td width="200" align="right">Line Token</td>
                    <td width="10" align="center">:</td>
                    <td><select class="custom-select" id="inputGroupSelect02" name="notifystate">
                            <option value="1" <?php
                                                if ($inotifystate == '1') {
                                                    echo 'selected="selected"';
                                                }
                                                ?>>เปิดการแจ้งเตือน</option>
                            <option value="0" <?php if ($inotifystate == '0') {
                                                    echo 'selected="selected"';
                                                } ?>>ปิดการแจ้งเตือน</option>
                        </select></td>
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