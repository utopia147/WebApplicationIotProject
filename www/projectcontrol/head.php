<?php
session_start();
//require 'includes/profile.inc.php';
if ($_SESSION['username'] == null) {
    header("location: login.php");
}
require "inc/connect.php";
$userid = $_SESSION['userid'];
$sessionstatus = $_SESSION['status'];
$sql = "SELECT * FROM users WHERE userid=$userid";
$result = mysqli_query($con, $sql);

$row = mysqli_fetch_array($result);
$username = $row['username'];
$fullname = $row['fname'] . " " . $row['lname'];
$profileimg  = $row['picture'];
$url_editprofile = "editprofile.php?id=$userid";
$url_editdevice = "editadvice.php?id=$userid";

mysqli_close($con);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project Control</title>
    <link rel="stylesheet" href="css/stylefooter.css">
    <link rel="stylesheet" href="css/styleheader.css">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<script>
    $(document).ready(function() {
        $('.nav li').click(function() {
            var location = window.location.href;

            // remove active class from all
            $(".navbar .nav-item").removeClass('active');

            // add active class to div that matches active url
            $(this).addClass('active');
        });
    });
</script>

<body style="background-color:#1b1f23">
    <div class="row">
        <div class="col-sm" style="background-color: #13151c">

        </div>
        <div class="col-sm-3" style="background-color: #13151c">
            <a href="<?php if ($sessionstatus != "R") {
                            echo "indexuser.php";
                        } else {
                            echo "viewchannel.php";
                        } ?>">
                <img src="img/Project.png" class="img-fluid" alt="Responsive image">
            </a>

        </div>
        <div class="col-sm" style="background-color: #13151c">

        </div>
    </div>
    <div class="row" style="background-color: #13151c">
        <div class="col-md-6 offset-md-3" style="background-color: #13151c">
            <header>
                <!-- Navigation -->
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></i></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo01" style="height:100px;">
                        <!----Logo---->
                        <?php if ($sessionstatus == 'R') { ?>
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="viewchannel.php">
                                        <h6>จัดการ Channel</h6>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="viewitem.php">
                                        <h6>จัดการอุปกรณ์</h6>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="viewsettime.php">
                                        <h6>จัดการตั้งเวลาควบคุม</h6>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="viewnotify.php">
                                        <h6>จัดการแจ้งรายงาน</h6>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="viewuserall.php">
                                        <h6>จัดการสมาชิกทั้งหมด</h6>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if ($sessionstatus != 'R') { ?>
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="indexuser.php">
                                            <h5>ควบคุมอุปกรณ์</h5>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="timeControl.php">
                                            <h5>ตั้งเวลาควบคุม</h5>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="notify.php">
                                            <h5>การแจ้งเตือน</h5>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="log.php">
                                            <h5>Log ควบคุมอุปกรณ์</h5>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php //if ($sessionstatus == 'A') {
                                //echo ' <li class="nav-item">
                                //<a class="nav-link" href="viewuser.php">จัดการสมาชิกภายในห้อง</a>
                                //</li>';
                                //}
                                ?>


                                <!-- Dropdown -->
                                </ul>

                                <div class="btn-group dropright" style="margin-bottom:2%;">
                                    <ul class="navbar-nav">
                                        <li class="nav-link dropdown-toggle dropdown-toggle-split" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="upload/pic/<?php echo  $profileimg; ?>" class="rounded-circle" style="width:70px;height:70px">
                                        </li>
                                        <div class="dropdown-menu" style="position: absolute; transform: translate3d(90px, 0px, 0px); top: 0px; left: 0px;">
                                            <a class="dropdown-item disabled"><i class="fas fa-portrait"></i>
                                                <?php echo $username; ?></a>
                                            <a class="dropdown-item disabled">
                                                <?php echo $fullname; ?> </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="<?php echo $url_editprofile; ?>"><i class="fas fa-user-edit"></i> Edit Account</a>
                                            <a class="dropdown-item  " href="inc/logout.inc.php "><i class="fas fa-sign-out-alt"></i> Logout</a>
                                        </div>



                                    </ul>
                                </div>

                    </div>
                </nav>

            </header>
        </div>
    </div>

    <div class="row" style="height:100%;">
        <div class="col-sm">
        </div>
        <div class="col-sm-11" style="height:auto;">