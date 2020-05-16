<?php

require "head.php";
session_start();
if ($_SESSION['username'] == null) {
    header("location: login.php");
}

require "inc/connect.php";
if ($_POST['submit'] != null) {
    $channelid = $_POST['channelid'];
    $timeon = $_POST['timeon'];
    $timeoff = $_POST['timeoff'];
    $sql = "UPDATE `settime` SET `timesetOn`='$timeon',`timesetOff`='$timeoff'
     WHERE channelid=$channelid";
    $result = mysqli_query($con, $sql);
    if ($result == 1) {
        echo ' <script type="text/javascript">
            window.location="timeControl.php";
            </script>';
    }
    //header("Location: controldevice.php");

    mysqli_close($con);
} else if ($_GET['id'] != null) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `settime` WHERE channelid = $id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $row = mysqli_fetch_array($result);
        $channelid = $row["channelid"];
        $timeon = $row["timesetOn"];
        $timeoff = $row["timesetOff"];
    }
}
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
</head>
<style>
    .container {
        margin-top: 5%;

    }

    .form1 {
        margin-bottom: 20%
    }

    .h2 {
        color: white;
    }

    p {
        margin-top: 10px;
    }

    .col-sm-12 {
        margin-left: 35%;
        margin-top: 30px;
        padding: 10px;
    }

    .col-sm-6 {
        padding: 30px;
        font-size: 20px;
        margin-top: 5%;
    }

    .btn {
        padding: 10px;
        border-radius: 5%;
        margin-top: 30px;
        margin-left: 45%;
    }
</style>
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
    <form method="post" action="" enctype="multipart/form-data" class="form1">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="h2">ตั้งเวลาควบคุม Channel</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6" style="background-color:white; border: 1px solid white; border-style:inset; ">
                <h3>สถานะ <span class="badge badge-pill badge-success">ON</span> <img src="img/lightbub.png" alt="" class="img-fluid" width="100" height="100" style="margin-bottom:6%;"></h3>
                <label>แชลแนลที่ <?php echo $channelid; ?></label>
                <input type="hidden" name="channelid" class="form-control" value="<?php echo $channelid ?>">
                <small class="form-text text-muted">ตั้งค่าเวลา</small>
                <div class="input-group mb-3">
                    <input type="text" name="timeon" class="form-control" id="timepicker" placeholder="ตั้งเวลาสถานะ ON" size="20" value="<?php echo $timeon ?>">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2"><i class="far fa-clock"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6" style="background-color:white; border: 1px solid white; border-style:inset; ">
                <h3>สถานะ <span class="badge badge-pill badge-danger">OFF</span> <img src="img/lightoff.png" alt="" class="img-fluid" width="73" height="73" style="margin-bottom:3%;"></h3>
                <label>แชลแนลที่ <?php echo $channelid; ?></label>
                <small class="form-text text-muted">ตั้งค่าเวลา</small>
                <div class="input-group mb-3">
                    <input type="text" name="timeoff" class="form-control" id="timepicker" placeholder="ตั้งเวลาสถานะ OFF" size="20" value="<?php echo $timeoff ?>">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2"><i class="far fa-clock"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <input name="submit" type="submit" class="btn btn-outline-primary size="20" value="ตั้งเวลา"></<input>
    </form>
</div>

<?php

require "footer.php";
?>