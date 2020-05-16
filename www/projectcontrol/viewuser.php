<?php
require "head.php";

require "inc/connect.php";
$roomid = $_SESSION['roomid'];
$status = $_SESSION['status'];
$sql = "SELECT * FROM users WHERE roomid = $roomid";
$result = mysqli_query($con, $sql);

?>

<div class="container">
    <div class="postable">
        <div class="row">
            <div class="col-sm-12">
                <h5 style="color:white;">A = เจ้าของห้อง U = สมาชิกในห้อง</h5>
                <table class="table table-hover">
                    <thead>
                        <tr class="table-light">
                            <th>ลำดับ</th>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Picture</th>
                            <th>สถานะ</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $userid = $row['userid'];
                            $url_editprofile = "editprofile.php?id=$userid";
                            $url_deleteprofile = "inc/deleteprofile.php?id=$userid";
                            ?>
                            <tr class="table-light">
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['userid']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['password']; ?></td>
                                <td><?php echo $row['fname']; ?></td>
                                <td><?php echo $row['lname']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><img src="upload/pic/<? echo  $row['picture']; ?>" style="width:70px;height:70px"></td>
                                <td><?php echo $row['status']; ?></td>
                                <td><a class="dropdown-item  " href="adduser.php "><i class="fas fa-user-plus"></i> Add</a></td>
                                <td><a class="dropdown-item" href="<? echo $url_editprofile; ?>"><i class="fas fa-user-edit"></i> Edit</a></td>
                                <td><a class="dropdown-item" href="<? echo $url_deleteprofile; ?>" onclick="return confirm('Are you sure to delete?')"><i class="fas fa-trash-alt"></i> Delete</a></td>
                            </tr>
                        <?php }
                        mysqli_close($con);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
require "footer.php";
?>