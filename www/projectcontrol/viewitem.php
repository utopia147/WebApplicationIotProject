<?php
require "head.php";

require "inc/connect.php";

$sql = "SELECT * FROM item";
$result = mysqli_query($con, $sql);

?>


<div class="row">
    <div class="col-sm-12">
        <hr>
        <h5 style="color:white;">จัดการอุปกรณ์</h5>
        <p class="text-right"><a class="text-light" href="additem.php "><i class="fas fa-plus-square"></i> Add Item</a></p>
        <hr>
        <table class="table table-hover">
            <thead>
                <tr class="table-light">
                    <th>ลำดับ</th>
                    <th>Channel ID</th>
                    <th>ชื่อ Channel</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php

                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $itemid = $row['itemid'];
                    $url_edititem = "edititem.php?id=$itemid";
                    $url_deleteitem = "inc/deleteitem.php?id=$itemid";
                    ?>
                    <tr class="table-light">
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['channelid']; ?></td>
                        <td><?php echo $row['itemname']; ?></td>
                        <td><a class="dropdown-item" href="<?php echo $url_edititem; ?>"><i class="fas fa-edit"></i> Edit</a></td>
                        <td><a class="dropdown-item" href="<?php echo $url_deleteitem; ?>" onclick="return confirm('Are you sure to delete?')"><i class="fas fa-trash-alt"></i>Delete</a></td>
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