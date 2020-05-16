<?php

require "head.php";
require "inc/connect.php";

if ($_POST['submit'] != null) {
    $channelid = $_POST['channelid'];
    $itemname = $_POST['itemname'];
    $itemid = $_POST['itemid'];

    $sql = "UPDATE `item` SET `itemname`='$itemname',`channelid`='$channelid'
     WHERE itemid=$itemid";
    $result = mysqli_query($con, $sql);
    if ($result == 1) {
        echo ' <script type="text/javascript">
            window.location="viewitem.php";
            </script>';
    }
    //header("Location: controldevice.php");

    mysqli_close($con);
} else if ($_GET['id'] != null) {
    $id = $_GET['id'];
    $sql = "SELECT `itemid`, `channelid`, `itemname` FROM `item` WHERE itemid=$id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $row = mysqli_fetch_array($result);

        $ichannelid = $row['channelid'];
        $itemid = $row['itemid'];
        $itemname = $row['itemname'];
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
                        <h3>แก้ไข อุปกณ์</h3>
                    </td>
                </tr>
            </table>
            <table width="600" border="0" cellspacing="1" cellpadding="1" align="center">
                <tr>
                    <td width="200" align="right">ITEM ID</td>
                    <td width="10" align="center">:</td>
                    <td><input name="itemid" type="text" size="2" value="<?php echo $itemid; ?>" readonly></td>
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
                    <td width="200" align="right">ชื่อ อุปกรณ์</td>
                    <td width="10" align="center">:</td>
                    <td><input name="itemname" type="text" size="30" value="<?php echo $itemname; ?>"></td>
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