<?php
require "head.php";

require "inc/connect.php";

$sql = "SELECT * FROM settime";
$result = mysqli_query($con, $sql);

?>


<div class="row" style="margin-bottom:25%">
    <div class="col-sm-12">
        <hr>
        <h5 style="color:white;">จัดการตั้งเวลาควบคุม</h5>
        <p class="text-right"><a class="text-light" href="addtimeset.php "><i class="fas fa-plus-square"></i> Add time</a></p>
        <hr>
        <table class="table table-hover">
            <thead>
                <tr class="table-light">
                    <th>ลำดับ</th>
                    <th>Time ID</th>
                    <th>Channel ID</th>
                    <th>State ON</th>
                    <th>Timeset ON</th>
                    <th>State OFF</th>
                    <th>Timeset OFF</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php

                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $timeid = $row['timeid'];
                    $url_edittiemset = "edittimeset.php?id=$timeid";
                    $url_deletetimeset = "inc/deletetimeset.php?id=$timeid";
                    if ($row['stateOn'] == '0') {
                        $state_on = "ปิดการใช้งาน";
                    } else {
                        $state_on = "เปิดการใช้งาน";
                    }
                    if ($row['stateOff'] == '0') {
                        $state_off = "ปิดการใช้งาน";
                    } else {
                        $state_off = "เปิดการใช้งาน";
                    }
                ?>
                    <tr class="table-light">
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['timeid']; ?></td>
                        <td><?php echo $row['channelid']; ?></td>
                        <td><?php echo $state_on; ?></td>
                        <td><?php echo $row['timesetOn']; ?></td>
                        <td><?php echo $state_off; ?></td>
                        <td><?php echo $row['timesetOff']; ?></td>
                        <td><a class="dropdown-item" href="<?php echo $url_edittiemset; ?>"><i class="fas fa-edit"></i> Edit</a></td>
                        <td><a class="dropdown-item" href="<?php echo $url_deletetimeset; ?>" onclick="return confirm('Are you sure to delete?')"><i class="fas fa-trash-alt"></i>Delete</a></td>
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