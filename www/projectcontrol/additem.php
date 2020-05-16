<?php
require "head.php";
session_start();
require "inc/connect.php";

$sql = "SELECT `channelid` FROM `channel`";
$result = mysqli_query($con, $sql);



?>
<link rel="stylesheet" href="css/stylecontent.css">

<div class="container">
    <div class="box1">
        <form class="form1" method="post" action="inc/saveitem.inc.php" enctype="multipart/form-data">
            <table width="600" border="0" cellspacing="1" cellpadding="1" align="center" class="table1">
                <tr>
                    <td height="50" align="center">
                        <h3>เพิ่มอุปกรณ์</h3>
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
                    <td width="200" align="right">ชื่อ อุปกรณ์</td>
                    <td width="10" align="center">:</td>
                    <td><input name="itemname" type="text" size="30"></td>
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