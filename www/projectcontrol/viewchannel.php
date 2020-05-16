<?php
require "head.php";

require "inc/connect.php";

$sql = "SELECT * FROM channel";
$result = mysqli_query($con, $sql);

?>


<div class="row" style="margin-bottom:25%">
    <div class="col-sm-12">
        <hr>
        <h5 style="color:white;">จัดการแชลแนลทั้งหมด</h5>
        <p class="text-right"><a class="text-light" href="addchannel.php "><i class="fas fa-plug"></i> Add channel</a></p>
        <hr>

        <table class="table table-hover">
            <thead>
                <tr class="table-light">
                    <th>ลำดับ</th>
                    <th>Channel ID</th>
                    <th>ชื่อ Channel</th>
                    <th>รายละเอียด</th>
                    <th>สถานะที่เชื่อมต่อ</th>
                    <th>สถานะของ Channel</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php

                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $channelid = $row['channelid'];
                    $url_editchannel = "editchannel.php?id=$channelid";
                    $url_deletechannel = "inc/deletechannel.php?id=$channelid";
                ?>
                    <tr class="table-light">
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['channelid']; ?></td>
                        <td><?php echo $row['channelname']; ?></td>
                        <td><?php echo $row['descrip']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['channelstatus']; ?></td>
                        <td><a class="dropdown-item" href="<?php echo $url_editchannel; ?>"><i class="far fa-edit"></i> Edit</a></td>
                        <td><a class="dropdown-item" href="<?php echo $url_deletechannel; ?>" onclick="return confirm('Are you sure to delete?')"><i class="fas fa-trash-alt"></i>Delete</a></td>
                    </tr>
                <?php }
                mysqli_close($con);
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
require "footer.php";
?>