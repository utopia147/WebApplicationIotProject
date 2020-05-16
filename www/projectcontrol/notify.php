<?php

require "head.php";
session_start();
if ($_SESSION['username'] == null) {
    header("location: login.php");
}

require "inc/connect.php";



$sql = "SELECT * FROM `notify` WHERE 1";
$result = mysqli_query($con, $sql);
if ($result) {
    $row = mysqli_fetch_array($result);
    $notifyid = $row["notifyid"];
    $notifystate = $row["notifystate"];
    $linetoken = $row["linetoken"];
    $notifytime = $row["notifytime"];
}

?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
</head>
<style>
    .container {
        margin-top: 5%;
    }

    .h5 {
        padding: 5px;
    }

    .toggle.ios,
    .toggle-on.ios,
    .toggle-off.ios {
        border-radius: 30px;

    }

    .toggle.ios .toggle-handle {
        border-radius: 30px;

    }

    input[type="submit"] {
        padding: 10px;
        margin-left: 47%;
        margin-top: 5px;
    }
</style>
<script>
    $(document).ready(function() {
        $('input#notifysw').change(function() {
            var checkStatus = $(this).prop('checked');
            if (checkStatus == true) {
                var notifystate = 1;
            } else if (checkStatus == false) {
                var notifystate = 0;
            }
            var notifyid = $(this).val();
            var url = "inc/notify.inc.php";
            var dataSet = {
                notifystate: notifystate,
                notifyid: notifyid
            };
            console.log(checkStatus);
            console.log(notifystate);
            console.log(notifyid);
            console.log(dataSet);
            console.log(url);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: 'JSON',
                data: dataSet,
                success: function(data) {
                    var data = eval(data);
                    message = data.response_result;
                    success = data.success;
                    console.log(success);
                    console.log(message);

                }
            });
        });
    });
</script>
<div class="container">
    <form method="post" action="inc/notify.inc.php" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-6" style="margin-bottom:2%;">
                <h2 style="color:#ffc107">Notifications <i class="fas fa-bell"></i></h2>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12" style="background-color:whitesmoke; color:black">
                <table class="table table-borderless">
                    <tr>
                        <td>
                            <h5 class="h5">เปิดปิดการแจ้งเตือน</h5>
                        </td>
                        <?php if ($notifystate == 1) { ?>
                            <td> <input type="checkbox" id="notifysw" checked data-toggle="toggle" data-style="ios" data-onstyle="primary" data-offstyle="secondary" value="<?php echo $notifyid; ?>"></td>
                        <?php } else { ?>
                            <td> <input type="checkbox" id="notifysw" data-toggle="toggle" data-style="ios" data-onstyle="primary" data-offstyle="secondary" value="<?php echo $notifyid; ?>"></td>
                        <?php } ?></h5>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="h5">Line Token</h5>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="<?php echo $linetoken; ?>" readonly>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="h5">ตั้งเวลาการแจ้งเตือน</p>
                        </td>
                        <td><input type="hidden" name="notifyid" value="<?php echo $notifyid ?>">
                            <input type="hidden" name="userid" value="<?php echo $userid ?>">
                            <div class="input-group mb-3">
                                <select class="custom-select" id="inputGroupSelect02" name="notifytime">
                                    <?php

                                    if ($notifytime == '3600000') {
                                        echo '<option value="3600000" selected=selected>แจ้งเตือนทุกๆ 1 ชั่วโมง</option>';
                                    } else {
                                        echo '<option value="3600000"> แจ้งเตือนทุกๆ 1 ชั่วโมง</option>';
                                    }
                                    if ($notifytime == '10800000') {
                                        echo '<option value="10800000" selected=selected>แจ้งเตือนทุกๆ 3 ชั่วโมง</option>';
                                    } else {
                                        echo '<option value="10800000" >แจ้งเตือนทุกๆ 3 ชั่วโมง</option>';
                                    }
                                    if ($notifytime == '21600000') {
                                        echo '<option value="21600000" selected=selected>แจ้งเตือนทุกๆ 6 ชั่วโมง</option>';
                                    } else {
                                        echo '<option value="21600000" >แจ้งเตือนทุกๆ 6 ชั่วโมง</option>';
                                    }
                                    if ($notifytime == '43200000') {
                                        echo '<option value="43200000" selected=selected>แจ้งเตือนทุกๆ 12 ชั่วโมง</option>';
                                    } else {
                                        echo '<option value="43200000" >แจ้งเตือนทุกๆ 12 ชั่วโมง</option>';
                                    }
                                    if ($notifytime == '43200000') {
                                        echo '<option value="86400000" selected=selected>แจ้งเตือนทุกๆ 24 ชั่วโมง</option>';
                                    } else {
                                        echo '<option value="86400000">แจ้งเตือนทุกๆ 24 ชั่วโมง</option>';
                                    }

                                    ?>
                                </select>

                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button"><i class="fas fa-hourglass-start"></i></button>
                                </div>
                        </td>
            </div>
            </tr>
            </table>
        </div>
</div>

<input name="submit" type="submit" class="btn btn-outline-warning" size="20" value="บันทึก">
</form>
</div>

<?php

require "footer.php";
?>