<?php

require "head.php";
session_start();
if ($_SESSION['username'] == null) {
    header("location: login.php");
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
<div class="container">
    <form method="post" action="inc/saveuser.inc.php" enctype="multipart/form-data">
        <table width="600" border="0" cellspacing="1" cellpadding="1" align="center" class="table2">
            <tr>
                <td height="50" align="center">
                    <h2 class="h2">เพิ่มบัญชีสมาชิกของห้อง</h2>
                </td>
            </tr>
        </table>
        <table class="table1" width="600" border="0" cellspacing="1" cellpadding="1" align="center">
            <tr>
                <td align="right" width="200">Username</td>
                <td width="10" align="center">:</td>
                <td><input type="text" class="form-control" placeholder="Username" name="username"></td>
            </tr>
            <tr>
                <td align="right" width="200">Password</td>
                <td width="10" align="center">:</td>
                <td> <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password"></td>
            </tr>
            <tr>
                <td align="right" width="200">Firstname</td>
                <td width="10" align="center">:</td>
                <td> <input type="text" class="form-control" placeholder="First name" name="firstname"></td>
            </tr>
            <tr>
                <td align="right" width="200">Lastname</td>
                <td width="10" align="center">:</td>
                <td><input type="text" class="form-control" placeholder="Last name" name="lastname"></td>
            </tr>
            <tr>
                <td align="right" width="200">Email</td>
                <td width="10" align="center">:</td>
                <td><input name="email" type="email" placeholder="example@xxxmail.com" size="20" maxlength="50"></td>
            </tr>
            <tr>
                <td align="right" width="200">Profile Picture</td>
                <td width="10" align="center">:</td>
                <td><input type="file" class="form-control-file" id="exampleFormControlFile1" name="picture"></td>
            </tr>
            <tr>
                <td align="right" width="200">Status</td>
                <td width="10" align="center">:</td>
                <td><select name="status">
                        <option value="A">เจ้าของห้อง</option>
                        <option value="U">สมาชิกในห้อง</option>

                    </select></td>
            </tr>
            <tr>
                <td align="right" width="200"></td>
                <td width="10" align="center"></td>
                <td><input name="submit" type="submit" class="btn btn-primary" size="20" value="submit"></td>
            </tr>
        </table>
    </form>
</div>

<?php

require "footer.php";
?>