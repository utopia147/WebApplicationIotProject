<?php

require "head.php";
session_start();
require "inc/connect.php";

$id = $_GET['id'];
if ($_POST['submit'] != null) {
    $userid = $_SESSION['userid'];
    $newusername = $_POST['username'];
    $newpassword = $_POST['password'];
    $newfirstname = $_POST['firstname'];
    $newlastname = $_POST['lastname'];
    $newemail = $_POST['email'];
    $newpicture = $_FILES['picture']['name'];
    $newstatus = $_POST['status'];
    $target_dir = 'upload/pic/';
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
        echo "sucess";
    }

    $sql = "UPDATE `users` SET `username`='$newusername',`password`='$newpassword',
    `fname`='$newfirstname',`lname`='$newlastname',`email`='$newemail',`picture`='$newpicture',`status`='$newstatus'
     WHERE userid=$id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        if ($_SESSION['status'] == 'R') {
            echo ' <script type="text/javascript">
                window.location="viewuserall.php";
                </script>';
        } else {
            echo ' <script type="text/javascript">
            window.location="indexuser.php";
            </script>';
        }
    }

    mysqli_close($con);
} else if ($_GET['id'] != null) {

    $sql = "SELECT * FROM users WHERE userid=$id";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_array($result);
    $username = $row['username'];
    $password = $row['password'];
    $firstname = $row['fname'];
    $lastname = $row['lname'];
    $email = $row['email'];
    $picture = $row['picture'];
    $status = $row['status'];
}

?>


<style>
    table {
        color: white;
        font-size: 24px;
        margin-top: 10px;
        padding: 10px;

    }

    .h2 {
        margin-left: 100px;
    }

    form {
        margin-top: 10%;
        margin-right: 100px;
    }

    .btn {
        padding: 10px;
        border-radius: 5%;
        margin-top: 10px;
    }
</style>
<?php
//break
?>
<div class="container">
    <form method="post" action="" enctype="multipart/form-data">
        <table width="600" border="0" cellspacing="1" cellpadding="1" align="center" class="table2">
            <tr>
                <td height="50" align="center">
                    <h2 class="h2">แก้ไขบัญชี</h2>
                </td>
            </tr>
        </table>
        <table class="table1" width="600" border="0" cellspacing="1" cellpadding="1" align="center">
            <tr>
                <td align="right" width="200">Username</td>
                <td width="10" align="center">:</td>
                <td><input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $username; ?>"></td>
            </tr>
            <tr>
                <td align="right" width="200">Password</td>
                <td width="10" align="center">:</td>
                <td> <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" value="<?php echo $password; ?>"></td>
            </tr>
            <tr>
                <td align="right" width="200">Firstname</td>
                <td width="10" align="center">:</td>
                <td> <input type="text" class="form-control" placeholder="First name" name="firstname" value="<?php echo $firstname; ?>"></td>
            </tr>
            <tr>
                <td align="right" width="200">Lastname</td>
                <td width="10" align="center">:</td>
                <td><input type="text" class="form-control" placeholder="Last name" name="lastname" value="<?php echo $lastname; ?>"></td>
            </tr>
            <tr>
                <td align="right" width="200">Email</td>
                <td width="10" align="center">:</td>
                <td><input name="email" type="email" placeholder="example@xxxmail.com" size="20" maxlength="50" value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
                <td align="right" width="200">Profile Picture</td>
                <td width="10" align="center">:</td>
                <td><img src="upload/pic/<?php echo $picture ?>" class="rounded-circle" style="width:128px;height:128px;"><br>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="picture"></td>
            </tr>
            <tr>
                <?php if ($_SESSION['status'] == 'R') { ?>
                    <td align="right" width="200">Status</td>
                    <td width="10" align="center">:</td>
                    <td><select name="status">
                            <option value="A" <?php if ($status == 'A') {
                                                        echo 'selected';
                                                    } ?>>เจ้าของห้อง</option>
                            <option value="U" <?php if ($status == 'U') {
                                                        echo 'selected';
                                                    } ?>>สมาชิกในห้อง</option>

                        </select></td><?php } ?>
            </tr>
            <tr>
                <td align="right" width="200"></td>
                <td width="10" align="center"></td>
                <td><input name="submit" type="submit" class="btn btn-primary" size="20" value="Submit"></td>
            </tr>
        </table>
    </form>
</div>

<?php

require "footer.php";
?>