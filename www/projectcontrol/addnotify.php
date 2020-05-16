<?php
require "head.php";
session_start();
require "inc/connect.php";

$sql = "SELECT `userid` FROM `users`WHERE status != 'R'";
$result = mysqli_query($con, $sql);



?>
<link rel="stylesheet" href="css/stylecontent.css">

<div class="container">
    <div class="box1">
        <form class="form1" method="post" action="inc/savenotify.inc.php" enctype="multipart/form-data">
            <table width="600" border="0" cellspacing="1" cellpadding="1" align="center" class="table1">
                <tr>
                    <td height="50" align="center">
                        <h3>เพิ่มการแจ้งรายงาน</h3>
                    </td>
                </tr>
            </table>
            <table width="600" border="0" cellspacing="1" cellpadding="1" align="center">
                <tr>
                    <td width="200" align="right">User ID</td>
                    <td width="10" align="center">:</td>
                    <td><select class="form-control" name="userid">
                            <?php if ($result) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $userid = $row["userid"];
                                    ?>
                                    <option value="<?php echo $userid; ?>"> <?php echo $userid; ?></option>
                            <?php
                                }
                            }
                            mysqli_close($con);
                            ?>
                        </select> </td>

                </tr>
                <tr>
                    <td width="200" align="right">Line Token</td>
                    <td width="10" align="center">:</td>
                    <td><input name="linetoken" type="text" size="30"></td>
                </tr>
                <tr>
                    <td width="200" align="right">แจ้งรายงาน</td>
                    <td width="10" align="center">:</td>
                    <td> <select class="custom-select" id="inputGroupSelect02" name="notifytime">
                            <option value="3600000">แจ้งเตือนทุกๆ 1 ชั่วโมง</option>
                            <option value="10800000">แจ้งเตือนทุกๆ 3 ชั่วโมง</option>
                            <option value="21600000">แจ้งเตือนทุกๆ 6 ชั่วโมง</option>
                            <option value="43200000">แจ้งเตือนทุกๆ 12 ชั่วโมง</option>
                            <option value="86400000">แจ้งเตือนทุกๆ 24 ชั่วโมง</option>
                        </select></td>
                </tr>
                <tr>
                    <td width="200" align="right">สถานะ</td>
                    <td width="10" align="center">:</td>
                    <td> <select class="custom-select" id="inputGroupSelect02" name="notifystate">
                            <option value="1">เปิดการแจ้งเตือน</option>
                            <option value="0">ปิดการแจ้งเตือน</option>
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