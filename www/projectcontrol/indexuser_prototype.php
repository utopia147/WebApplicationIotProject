<?php
require "head.php";

?>
<style>
    .container {
        height: 100%;
        width: 100%;
        position: relative;

    }


    .btntg {
        margin-left: 35%;
        margin-top: 5%;

    }

    .h1 {
        text-align: center;
    }

    .p1 {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        font-size: 16px;
        text-overflow: initial;

    }

    .toggle.ios,
    .toggle-on.ios,
    .toggle-off.ios {
        border-radius: 50%;
    }

    .toggle.ios .toggle-handle {
        border-radius: 50%;
    }
</style>


<?php
require "inc/connect.php";


?>
<link href="css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>



<div class="positionindex">
    <div class="container">
        <h1 class="h1" style="font-family: Helvetica;color: white;padding:20px;"> Project control channel</h1>
        <?php
        $sql = "SELECT * FROM channel";
        $result = mysqli_query($con, $sql);
        $no = 0;

        ?>
        <div class="row">
            <?php while ($row = mysqli_fetch_array($result)) {
                $no++;

                $channelid = $row['channelid'];
                $status = $row['status'];
                $descrip = $row['descrip'];
                $channelstatus = $row['channelstatus'];
                ?>

                <div class="col-sm-3">
                    <div class="card text-white mb-3" style="max-width: 30rem;  background-color:#2d3844">
                        <div class="card-header">
                            <h5><span class="badge badge-primary"> <i class="fas fa-plug"></i> <?php echo "แชแนลที่ " . $channelid; ?></span></h5>
                        </div>
                        <div class="card-body">
                            <!-- <h4 class="card-title" style="padding:5px;"><i class="fas fa-scroll"></i> รายละเอียด Channel</h4>
                            <p class="card-text">--> <?php /*  if ($descrip != null) {
                                                            echo $descrip;
                                                        } else {
                                                            echo "N/A";
                                                        }
                                                        */ ?>
                            </p><input type="hidden" id="userid" value="<?php echo $userid ?>">
                            <?php
                                if ($status == '1') { ?>

                                <div class="btntg">
                                    <input type="checkbox" id="switch" class="btntoggle" name="toggleBtn" checked data-toggle="toggle" data-style="ios" <?php if ($channelstatus == 0) { ?> disabled data-onstyle="light" data-offstyle="light" data-on="Disable" data-off="Disable" <?php } ?> <?php if ($channelstatus == 1) { ?> data-on="ON" data-off="OFF" data-onstyle="outline-success" data-offstyle="outline-danger" <?php } ?> data-width="100" data-height="100" value="<?php echo $channelid; ?>">
                                </div>
                            <?php } elseif ($status == '0') { ?>

                                <div class="btntg">
                                    <input type="checkbox" id="switch" class="btntoggle" name="toggleBtn" data-toggle="toggle" data-style="ios" <?php if ($channelstatus == 0) { ?> disabled data-onstyle="light" data-offstyle="light" data-on="Disable" data-off="Disable" <?php } ?> <?php if ($channelstatus == 1) { ?> data-on="ON" data-off="OFF" data-onstyle="outline-success" data-offstyle="outline-danger" <?php } ?> data-width="100" data-height="100" value="<?php echo $channelid; ?>">
                                </div>
                            <?php } ?>
                            <h5 style="padding:5px;margin-top:10%;">
                                <a class="btn btn-warning" style="margin:0;" data-toggle="collapse" href="#multiCollapseExample<?php echo $channelid ?>" role="button" aria-expanded="false" aria-controls="multiCollapseExample<?php echo $channelid ?>">
                                    <i class="fas fa-charging-station"></i> อุปกรณ์ที่เชื่อมต่อ</a> </h5>
                            <div class='collapse multi-collapse' id='multiCollapseExample<?php echo $channelid ?>'>
                                <?php
                                    $sql1 = "SELECT * FROM item WHERE channelid = $channelid";
                                    $result1 = mysqli_query($con, $sql1);
                                    $no2 = 0;
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        $no2++;
                                        $itemchannelid = $row1['channelid'];
                                        $itemname = $row1['itemname'];
                                        if ($channelid == $no) {
                                            if (mysqli_num_rows($result1) >= 1) {
                                                echo "<h5 style='margin-left:5%;margin-top:2%;'>" . $no2 . "." . $itemname . "</h5>";
                                            } else {
                                                echo "<p>N/A</p>";
                                            }
                                        }
                                    } ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('input:checkbox').change(function() {
            var checkStatus = $(this).prop('checked');
            if (checkStatus == true) {
                var status = "1";
                var statuslog = "ON";
            }
            if (checkStatus == false) {
                var status = "0";
                var statuslog = "OFF";
            }
            var channelid = $(this).val();
            var userid = $('#userid').val();
            var url = "inc/channelcontrol.inc.php";
            var dataSet = {
                status: status,
                statuslog: statuslog,
                channelid: channelid,
                userid: userid
            };
            console.log(checkStatus);
            console.log(statuslog);
            console.log(status);
            console.log(channelid);
            console.log(userid);
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