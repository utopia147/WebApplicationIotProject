<?php
require "head.php";

require "inc/connect.php";

$sql = "SELECT * FROM settime";
$result = mysqli_query($con, $sql);

?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link rel="stylesheet" href="compiled/flipclock.css">
<script src="compiled/flipclock.js"></script>
<style>
    .col-sm-12 {
        background: #1b1f23;

    }

    .card {
        margin-left: 25%;
        margin-top: 0.5%;
    }

    .toggle.ios,
    .toggle-on.ios,
    .toggle-off.ios {
        border-radius: 30px;

    }

    .toggle.ios .toggle-handle {
        border-radius: 30px;

    }
</style>

<div class="container">
    <div class="row">
        <div class="col-sm">
        </div>
        <!-- <div class="col-sm-12">
            <div class="card card bg-light " style="max-width: 35rem;">
                <div class="card-body">
                    <h5 class="card-title">เวลา Real Time</h5>
                    <p class="card-text">
                        <div class="clock" style="margin:2em;"></div>
                    </p>
                </div>
            </div>
        </div> -->
    </div>
    <div class="col-sm">
    </div>


    <div class="postable">
        <div class="row">
            <div class="col-sm-12">
            </div>
            <div class="col-sm-12" style="margin-bottom:25%;margin-top:6%;">
                <hr>
                <h5 style="color:white;"><i class="fas fa-stopwatch"></i> ตั้งค่าเวลา</h5>
                <hr>
                <div class="table-responsive-xl">
                    <table class="table table-hover table-dark">
                        <thead>
                            <tr>
                                <th scope="col">ตั้งเวลา Channel </th>
                                <th scope="col">เวลา เปิด-ปิด</th>
                                <th scope="col">Switch On</th>
                                <th scope="col">Switch Off</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $channelid = $row['channelid'];
                                $url_timeset = "timeSet.php?id=$channelid";
                                $timeseton = $row['timesetOn'];
                                $timesetoff = $row['timesetOff'];
                                $stateon = $row['stateOn'];
                                $stateoff = $row['stateOff'];

                            ?>
                                <tr>
                                    <td><a class="" style="color:inherit;text-decoration: none !important" href="<?php echo $url_timeset; ?>"><i class="fas fa-plug"></i> CH-<?php echo $channelid; ?></a></td>
                                    <td><?php echo $timeseton . " - " . $timesetoff; ?></td>
                                    <td>
                                        <?php if ($stateon == 1) { ?>
                                            <input type="checkbox" id="switchon" checked data-toggle="toggle" data-style="ios" data-onstyle="primary" data-offstyle="secondary" value="<?php echo $channelid; ?>">
                                        <?php } else { ?>
                                            <input type="checkbox" id="switchon" data-toggle="toggle" data-style="ios" data-onstyle="primary" data-offstyle="secondary" value="<?php echo $channelid; ?>">
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($stateoff == 1) { ?>
                                            <input type="checkbox" id="switchoff" checked data-toggle="toggle" data-style="ios" data-onstyle="primary" data-offstyle="secondary" value="<?php echo $channelid; ?>">
                                        <?php } else { ?>
                                            <input type="checkbox" id="switchoff" data-toggle="toggle" data-style="ios" data-onstyle="primary" data-offstyle="secondary" value="<?php echo $channelid; ?>">
                                        <?php } ?>
                                    </td>

                                </tr>
                            <?php }
                            mysqli_close($con);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var clock;

    $(document).ready(function() {
        clock = $('.clock').FlipClock({
            clockFace: 'TwentyFourHourClock'
        });
        $('input#switchoff').change(function() {
            var checkStatus = $(this).prop('checked');
            if (checkStatus == true) {
                var statusoff = "1";
            } else if (checkStatus == false) {
                var statusoff = "0";
            }
            var channelid = $(this).val();
            var url = "inc/switchtime.inc.php";
            var dataSet = {
                statusoff: statusoff,
                channelid: channelid
            };
            console.log(checkStatus);
            console.log(statusoff);
            console.log(channelid);
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

        $('input#switchon').change(function() {
            var checkStatus = $(this).prop('checked');
            if (checkStatus == true) {
                var statuson = "1";
            } else if (checkStatus == false) {
                var statuson = "0";
            }
            var channelid = $(this).val();
            var url = "inc/switchtime.inc.php";
            var dataSet = {
                statuson: statuson,
                channelid: channelid
            };
            console.log(checkStatus);
            console.log(statuson);
            console.log(channelid);
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
<?php
require "footer.php";
?>