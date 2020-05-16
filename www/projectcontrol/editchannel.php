<?php

require "head.php";
require "inc/connect.php";

if ($_POST['submit'] != null) {
    $channelid = $_POST['channelid'];
    $channelname = $_POST['channelname'];
    $descrip = $_POST['descrip'];
    $channelstatus = $_POST['channelstatus'];
    $sql = "UPDATE `channel` SET `channelname`='$channelname',`descrip`='$descrip',
    `channelstatus`='$channelstatus' WHERE channelid=$channelid";
    $result = mysqli_query($con, $sql);
    if ($result == 1) {
        echo ' <script type="text/javascript">
            window.location="viewchannel.php";
            </script>';
    }
    //header("Location: controldevice.php");

    mysqli_close($con);
} else if ($_GET['id'] != null) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM channel WHERE channelid=$id";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_array($result);
    $channelid = $row['channelid'];
    $channelname = $row['channelname'];
    $descrip = $row['descrip'];
    $channelstatus = $row['channelstatus'];
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
                    <td width="200" align="right">Channel ID</td>
                    <td width="10" align="center">:</td>
                    <td><input name="channelid" type="text" size="1" readonly value="<?php echo $channelid; ?>"></td>
                </tr>
                <tr>
                    <td width="200" align="right">ชื่อ Channel</td>
                    <td width="10" align="center">:</td>
                    <td><input name="channelname" type="text" size="30" value="<?php echo $channelname; ?>"></td>
                </tr>
                <tr>
                    <td align="right">รายละเอียดของ Channel</td>
                    <td align="center">:</td>
                    <td><input name="descrip" type="text" size="30" value="<?php echo $descrip; ?>"></td>
                </tr>
                <tr>
                    <td align="right">สถานะของ Channel</td>
                    <td align="center">:</td>
                    <td> <select name="channelstatus">
                            <option value="1" <?php if ($channelstatus == "1") {
                                                    echo "selected=\" selected\"";
                                                } ?>>ใช้งาน</option>
                            <option value="0" <?php if ($channelstatus == "0") {
                                                    echo "selected=\" selected\"";
                                                } ?>>ยังไม่ใช้งาน</option>
                        </select></td>
                </tr>
                <tr>
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