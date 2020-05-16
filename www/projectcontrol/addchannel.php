<?php
require "head.php";
session_start();
require "inc/connect.php";
$sql = "SELECT `userid`, `username` FROM users WHERE status != 'R'";
$result = mysqli_query($con, $sql)
?>

<link rel="stylesheet" href="css/stylecontent.css">
<div class="container">
    <div class="box1">
        <form class="form1" method="post" action="inc/savechannel.inc.php" enctype="multipart/form-data">
            <table width="600" border="0" cellspacing="1" cellpadding="1" align="center" class="table1">
                <tr>
                    <td height="50" align="center">
                        <h3>เพิ่ม Channel</h3>
                    </td>
                </tr>
            </table>
            <table width="600" border="0" cellspacing="1" cellpadding="1" align="center">
                <tr>
                    <td width="200" align="right">Channel ID</td>
                    <td width="10" align="center">:</td>
                    <td><input name="channelid" type="text" size="3"></td>
                </tr>
                <tr>
                    <td align="right">USER</td>
                    <td align="center">:</td>
                    <td><select name="userid">
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <option value="<?php echo $row['userid']; ?>"><?php echo $row['username']; ?></option>
                            <?php }
                            mysqli_close($con);
                            ?>

                        </select></td>
                </tr>
                <tr>
                    <td width="200" align="right">ชื่อ Channel</td>
                    <td width="10" align="center">:</td>
                    <td><input name="channelname" type="text" size="30"></td>
                </tr>
                <tr>
                    <td align="right">รายละเอียดของ Channel</td>
                    <td align="center">:</td>
                    <td><textarea name="descrip" type="text" size="30"></textarea></td>
                </tr>
                <tr>
                    <td align="right">สถานะของ Channel</td>
                    <td align="center">:</td>
                    <td><select name="channelstatus" id="status">
                            <option value="1" selected="selected">ใช้งาน</option>
                            <option value="0">ยังไม่ใช้งาน </option>
                        </select></td>
                </tr>
                <tr>
                    <td height="50" align="right">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td><button class="btn btn-primary" type="submit" name="submit" value="submit"> Submit </button></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php

require "footer.php";

?>