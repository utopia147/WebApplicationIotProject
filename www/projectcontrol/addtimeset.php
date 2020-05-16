<?php
require "head.php";
session_start();
require "inc/connect.php";

$sql = "SELECT `channelid` FROM `channel`";
$result = mysqli_query($con, $sql);



?>
<link rel="stylesheet" href="css/stylecontent.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    $(document).ready(function() {
        $('input#timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 1,
            startTime: '00:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });
</script>
<div class="container">
    <div class="box1">
        <form class="form1" method="post" action="inc/savetimeset.inc.php" enctype="multipart/form-data">
            <table width="600" border="0" cellspacing="1" cellpadding="1" align="center" class="table1">
                <tr>
                    <td height="50" align="center">
                        <h3>เพิ่มการตั้งเวลา</h3>
                    </td>
                </tr>
            </table>
            <table width="600" border="0" cellspacing="1" cellpadding="1" align="center">
                <tr>
                    <td width="200" align="right">Channel ID</td>
                    <td width="10" align="center">:</td>
                    <td><select class="form-control" name="channelid">
                            <?php if ($result) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $channelid = $row["channelid"];
                                    ?>
                                    <option value="<?php echo $channelid; ?>">แชลแนลที่ <?php echo $channelid; ?></option>
                            <?php
                                }
                            }
                            mysqli_close($con);
                            ?>
                        </select> </td>

                </tr>
                <tr>
                    <td width="200" align="right">ตั้งเวลาสถานะ ON</td>
                    <td width="10" align="center">:</td>
                    <td><select class="form-control" name="stateOn">
                            <option value="1">เปิดการใช้งาน</option>
                            <option value="0">ปิดการใช้งาน</option>
                        </select></td>
                </tr>
                <tr>
                    <td width="200" align="right">เวลาเปิดอุปกรณ์</td>
                    <td width="10" align="center">:</td>
                    <td><input name="timesetOn" type="text" id="timepicker" value="00:00"></td>
                </tr>
                <tr>
                    <td width="200" align="right">ตั้งเวลาสถานะ OFF</td>
                    <td width="10" align="center">:</td>
                    <td><select class="form-control" name="stateOff">
                            <option value="1">เปิดการใช้งาน</option>
                            <option value="0">ปิดการใช้งาน</option>
                        </select></td>
                </tr>
                <tr>
                    <td width="200" align="right">เวลาปิดอุปกรณ์</td>
                    <td width="10" align="center">:</td>
                    <td><input name="timesetOff" type="text" id="timepicker" value="00:00"></td>
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