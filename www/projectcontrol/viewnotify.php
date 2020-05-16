<?php
require "head.php";

require "inc/connect.php";

$sql = "SELECT * FROM notify";
$result = mysqli_query($con, $sql);

?>


<div class="row">
    <div class="col-sm-12">
        <hr>
        <h5 style="color:white;">จัดการแจ้งรายงาน</h5>
        <p class="text-right"><a class="text-light" href="addnotify.php "><i class="fas fa-plug"></i> Add notify</a></p>
        <hr>

        <table class="table table-hover">
            <thead>
                <tr class="table-light">
                    <th>ลำดับ</th>
                    <th>User ID</th>
                    <th>Line Token</th>
                    <th>State</th>
                    <th>เวลาแจ้งรายงาน</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php

                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $notifyid = $row['notifyid'];
                    $url_editnotify = "editnotify.php?id=$notifyid";
                    $url_deletenotify = "inc/deletenotify.php?id=$notifyid";
                    if ($row['notifystate'] == '1') {
                        $statenotify = "เปิดการแจ้งเตือน";
                    } else {
                        $statenotify = "ปิดการแจ้งเตือน";
                    }
                    $sec = ($row['notifytime'] / 1000) % 60;
                    $min = ($row['notifytime'] / (1000 * 60)) % 60;
                    $hour = ($row['notifytime'] / (1000 * 60 * 60)) % 24;

                    ?>
                    <tr class="table-light">
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['userid']; ?></td>
                        <td><?php echo $row['linetoken']; ?></td>
                        <td><?php echo $statenotify; ?></td>
                        <td><?php echo  sprintf("เริ่มทุกๆ %02dh%02dm%02ds", $hour, $min, $sec); ?></td>
                        <td><a class="dropdown-item" href="<?php echo $url_editnotify; ?>"><i class="far fa-edit"></i> Edit</a></td>
                        <td><a class="dropdown-item" href="<?php echo $url_deletenotify; ?>" onclick="return confirm('Are you sure to delete?')"><i class="fas fa-trash-alt"></i>Delete</a></td>
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