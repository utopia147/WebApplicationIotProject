<?php
require "head.php";

?>

<style>
    .container {
        height: 100%;
        width: 100%;
        position: relative;

    }

    p {
        color: white;
        text-align: center;
    }

    hr {
        display: block;
        height: 1px;
        border: 0;
        border-top: 1px inset whitesmoke;
        margin: 1em 0;
        padding: 0;
    }

    .btntg {
        margin-left: 35%;
        margin-top: 5%;

    }

    h1 {
        text-align: center;
        color: whitesmoke;
        font-family: 'Poiret One', cursive;
        margin-bottom: 2%;
        ;
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

<header id="b4togglelink">

</header>
<link href="css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


<div class="container">
    <h1 class="display-4" style="margin-top:2%;"> Project Control Channel</h1>
    <hr>
    <!--  ส่วนแสดงผล -->
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
                <div class="card text-white mb-3" style="max-width: 30rem;  background-color: #13151c;">
                    <div class="card-header">
                        <h5><span class="badge badge-primary"> <i class="fas fa-plug"></i> <?php echo "แชแนลที่ " . $no; ?></span></h5>
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
                        </p><input type="hidden" id="fullname" value="<?php echo $fullname ?>">
                        <?php
                        if ($status == '1') { ?>

                            <div class="btntg" id="resultbtn">
                                <input type="checkbox" id="switch" class="btntoggle" name="toggleBtn" checked data-toggle="toggle" data-style="ios" <?php if ($channelstatus == 0) { ?> disabled data-onstyle="light" data-offstyle="light" data-on="Disable" data-off="Disable" <?php } ?> <?php if ($channelstatus == 1) { ?> data-on="ON" data-off="OFF" data-onstyle="outline-success" data-offstyle="outline-danger" <?php } ?> data-width="100" data-height="100" value="<?php echo $channelid;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>">
                            </div>
                        <?php } elseif ($status == '0') { ?>

                            <div class="btntg" id="resultbtn">
                                <input type="checkbox" id="switch" class="btntoggle" name="toggleBtn" data-toggle="toggle" data-style="ios" <?php if ($channelstatus == 0) { ?> disabled data-onstyle="light" data-offstyle="light" data-on="Disable" data-off="Disable" <?php } ?> <?php if ($channelstatus == 1) { ?> data-on="ON" data-off="OFF" data-onstyle="outline-success" data-offstyle="outline-danger" <?php } ?> data-width="100" data-height="100" value="<?php echo $channelid;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ?>">
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
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                $no2++;
                                $itemchannelid = $row1['channelid'];
                                $itemname = $row1['itemname'];
                                $itemid = $row1['itemid'];

                                if (mysqli_num_rows($result1) > 0) {
                                    echo "
                                    <h5 class='data$itemid' style='margin-left:5%; margin-top:2%; '> <input class='selectDevice$itemchannelid' type='hidden' value='$itemid'> " . $no2 . "." . $itemname . "</h5>";
                                }
                                if (mysqli_num_rows($result1) == $no2) {
                                    echo "<button id='deleteItem$itemchannelid' type='button' class='btn btn-sm btn-outline-danger' value='$itemchannelid'><i class='fas fa-backspace'></i> ลบอุปกรณ์</button>
                                    <button id='submit$itemchannelid' type='button' class='btn btn-sm btn-info' value='$itemchannelid' style='display: none;'><i class='fas fa-backspace'></i> Yes</button>
                                    <button id='unsubmit$itemchannelid' type='button' class='btn btn-sm btn-danger' value='$itemchannelid'style='display: none;'><i class='fas fa-backspace'></i> No</button>
                                    ";
                                }
                            }
                            if ($no <= mysqli_num_rows($result)) {
                                echo "<a href='additem_index.php?id=$channelid' id='addItem$itemchannelid' type='button' class='btn btn-sm btn-outline-success'><i class='fas fa-plus'></i> เพิ่มอุปกรณ์</a>";
                            }


                            ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
    <div class="row" style="margin-bottom:20%;">
        <div class="col-12">
            <hr>
            <h1 class="display-4">NodeMCU Status</h1>
            <div class="NodemcuStatus" id="NodemcuStatus">

            </div>
            <div id="showStatus" style="margin-bottom:40px"></div>

        </div>
    </div>
</div>
<script>
    $(function() {
        $('#b4togglelink').append('<link href="css/bootstrap-toggle.min.css" rel="stylesheet">');

        $('.btn.btn-outline-danger.active.toggle-off').removeClass('active')

        setInterval(refeshAppForNode, 500);
        $("button:button").click(function() {
            // console.log("hello");
            var itemchannelid = $(this).val();

            $("#addItem" + itemchannelid).fadeOut(10);
            $('#deleteItem' + itemchannelid).fadeOut(10);
            $('.selectDevice' + itemchannelid).attr('type', 'checkbox');
            $('#submit' + itemchannelid).show();
            $('#unsubmit' + itemchannelid).show();

            $('#submit' + itemchannelid).click(function() {
                
         
             var itemid;
                
                $.each($('.selectDevice' + itemchannelid + ':checked'), function() {
              
                    // data.push({NO:no , itemid : $(this).val()});
                 
                    itemid = $(this).val();
                    
                       
                        //  $('input[value='+ itemid +']').empty();
                    
                    
                
                        $(".data" + itemid).empty();

                        console.log('sucsess');
                        console.log(itemid);
                        $.ajax({
                    type: 'GET',
                    url: 'inc/deleteitem_index.php',
                    dataType: 'JSON',
                    data: {
                        'id':itemid
                    },
                });
            
               
                });
                
                $('.selectDevice' + itemchannelid).attr('type', 'hidden');
                $("#addItem" + itemchannelid).fadeIn();
                $('#deleteItem' + itemchannelid).fadeIn();
                $('#submit' + itemchannelid).hide();
                $('#unsubmit' + itemchannelid).hide();
 
            });
            $('#unsubmit' + itemchannelid).click(function() {
                $('.selectDevice' + itemchannelid).attr('type', 'hidden');
                $("#addItem" + itemchannelid).fadeIn();
                $('#deleteItem' + itemchannelid).fadeIn();
                $('#submit' + itemchannelid).hide();
                $('#unsubmit' + itemchannelid).hide();
            });
        });
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
            var fullname = $('#fullname').val();

            var dataUpdatelog = {
                status: status,
                statuslog: statuslog,
                channelid: channelid,
                userid: userid
            };
            var dataLineMsg = {
                statuslog: statuslog,
                channelid: channelid,
                fullname: fullname,
            };
            UpdateLog();
            LineNotify();
            //console.log(checkStatus);
            // console.log(statuslog);
            // console.log(status);
            // console.log(channelid);
            //console.log(userid);
            // console.log(dataSet);

            //console.log(fullname);
            function UpdateLog() {
                $.ajax({
                    type: 'POST',
                    url: 'inc/channelcontrol.inc.php',
                    dataType: 'JSON',
                    data: dataUpdatelog,
                    success: function(data) {
                        var data = eval(data);
                        message = data.response_result;
                        success = data.success;
                        console.log(success);
                        console.log(message);

                    }
                });
            }

            function LineNotify() {
                $.ajax({
                    type: 'POST',
                    url: 'inc/line_notify.php',
                    dataType: 'JSON',
                    data: dataLineMsg,
                    success: function(res) {
                        console.log(res);
                    }
                });
            }
        });
    });

    function refeshAppForNode() {
        $.ajax({
            type: "GET",
            url: "inc/indexuser_res.php",
            dataType: "json",
            cache: false,
            success: function(res) {

                var NodeStatus = res.NodeStatus;
                var alive = res.alive;
                var statusNode = res.statusNode;
                var strStatus = '<p class="h4" id="heading" style="color:white; padding:5px;">' + statusNode + '</p>'

                $('#NodemcuStatus').empty();
                $('#NodemcuStatus').append(' <img src="img/nodemcu.gif" class="rounded mx-auto d-block" width="400" height="210" alt="Image">');
                $('#showStatus').empty();
                $('#showStatus').append(strStatus);

                // console.log(NodeStatus);
                if (NodeStatus == 'Connected') {
                    if (alive == "0") {
                        $.ajax({
                            type: 'POST',
                            url: 'inc/app_respone.php',
                            dataType: 'JSON',
                            data: {
                                alive: "1"
                            },
                            success: function(data) {
                                var data = eval(data);
                                message = data.response_result;
                                success = data.success;
                                // console.log(success);
                                // console.log(message);

                            }
                        });
                        location.reload(true);


                    }

                }

                if (NodeStatus == 'Connection Timeout') {
                    var NodeTimeOut = res.NodeTimeOut;
                    var msgAlert = "Connection Problem : Disconnected in 00:" + NodeTimeOut;
                    $.ajax({
                        type: 'POST',
                        url: 'inc/app_respone.php',
                        dataType: 'JSON',
                        data: {
                            AppSayHiToNode: "NodeMCU Timeout",
                            alive: "0"
                        },
                        success: function(data) {
                            message = data.response_result;
                            success = data.success;
                            // console.log(success);
                            // console.log(message);

                        }
                    });
                    if (alive == "0") {
                        function Timeout(_NodeStatus) {
                            // console.log('wait');
                            var strNodeTimeOut = '<p class="mb-0" style="padding:5px;">' + msgAlert + ' <i class="fas fa-stopwatch"></i></p>';
                            $('div[id=resultbtn]').empty();
                            $('#NodemcuStatus').empty();
                            $('div[id=resultbtn]').append('<div class="toggle btn btn-outline-warning ios" data-toggle="toggle" style="width: 100px; height: 100px;"><input type="checkbox" id="switch" class="btntoggle" name="toggleBtn" checked="" data-toggle="toggle" data-style="ios" data-on="Disconect" data-off="Disconect" data-onstyle="danger" data-offstyle="danger" data-width="100" data-height="100" value="2"><div class="toggle-group"><label class="btn btn-outline-warning active toggle-on" style="line-height: 86px; color:white">Connecting</label><label class="btn btn-outline-warning active toggle-off" style="line-height: 86px;">Connecting</label><span class="toggle-handle btn btn-default"></span></div></div>');
                            $('#NodemcuStatus').append(' <img src="img/nodemcutimeout.gif" class="rounded mx-auto d-block" width="400" height="210" alt="Image">');
                            $('#showStatus').empty();
                            $('#showStatus').append(strStatus);
                            $('#showStatus').append(strNodeTimeOut);
                        };
                        Timeout(NodeStatus);


                    }
                }
                if (NodeStatus == 'Disconnected') {
                    var NodeLastestOnline = res.NodeLastestOnline;
                    var msgAlert = "กรุณาตรวจสอบ NodeMCUESP8266 ตอนนี้ไม่ได้ทำการเชื่อมต่อมายัง API";
                    $.ajax({
                        type: 'POST',
                        url: 'inc/app_respone.php',
                        dataType: 'JSON',
                        data: {
                            AppSayHiToNode: "NodeMCU Disconnected",
                            alive: "0"
                        },
                        success: function(data) {
                            message = data.response_result;
                            success = data.success;
                            // console.log(success);
                            // console.log(message);

                        }
                    });
                    if (alive == "0") {
                        function Disconnection(_NodeStatus) {
                            //console.log('cannot control');

                            var strNodeLastestOnline = '<p  class="text-sm-center">' + NodeLastestOnline + ' <i class="fas fa-stopwatch"></i></p>';
                            var strErrormsg = '<p  class="text-sm-center" id="para">' + msgAlert + '</p>';
                            $('div[id=resultbtn]').empty();
                            $('#NodemcuStatus').empty();
                            $('div[id=resultbtn]').append('<div class="toggle btn btn-outline-danger ios" data-toggle="toggle" style="width: 100px; height: 100px;"><input type="checkbox" id="switch" class="btntoggle" name="toggleBtn" checked="" data-toggle="toggle" data-style="ios" data-on="Disconect" data-off="Disconect" data-onstyle="danger" data-offstyle="danger" data-width="100" data-height="100" value="2"><div class="toggle-group"><label class="btn btn-outline-danger active toggle-on" style="line-height: 86px;">Disconnect</label><label class="btn btn-outline-danger active toggle-off" style="line-height: 86px;">Disconnect</label><span class="toggle-handle btn btn-default"></span></div></div>');
                            $('#NodemcuStatus').append(' <img src="img/nodemcudis.gif" class="rounded mx-auto d-block" width="400" height="210" alt="Image">');
                            $('#showStatus').empty();
                            $('#showStatus').append(strStatus);
                            $('#showStatus').append(strErrormsg);
                            $('#showStatus').append(strNodeLastestOnline);
                        }
                        Disconnection(NodeStatus);
                    } else {

                    }
                }
            }
        });
    }
</script>

<?php
require "footer.php";
?>