<?php
require "head.php";
?>
<script type="text/javascript">
    function showRecords(perPageCount, pageNumber, keyup, showAll) {
        $('#result').empty();
        var key = keyup;
        var showAll = showAll;
        $.ajax({
            type: "GET",
            url: "inc/search.php",
            data: {
                pageNumber: pageNumber,
                keyup: key,
                showAll: showAll
            },
            cache: false,
            beforeSend: function() {
                $('#loader').html('<img src="https://miro.medium.com/max/540/0*DqHGYPBA-ANwsma2.gif" alt="reload" width="150" height="150" style="margin-top:10px;">');
            },
            success: function(data) {
                setTimeout(function() {
                    $("#result").html(data);
                    $('#loader').html('');
                }, 500);
            }
        });
    }


    $(document).ready(function() {
        showRecords(50, 1, null, 0);
        $('#searchbox').keyup(function(e) {
            showRecords(50, 1, $(this).val(), 0);
            e.preventDefault();
        });
        $('#showToday').click(function(e) {
            var showToday = 0;
            showRecords(50, 1, null, showToday);
            e.preventDefault();
            $('#searchbox').keyup(function(e) {
                showRecords(50, 1, $(this).val(), showToday);
                e.preventDefault();
            });
        });
        $('#showAll').click(function(e) {
            var showAll = 1;
            showRecords(50, 1, null, showAll);
            e.preventDefault();
            $('#searchbox').keyup(function(e) {
                showRecords(50, 1, $(this).val(), showAll);
                e.preventDefault();
            });
        });
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-sm-12" style="margin-top:10%; margin-bottom:20%;">
            <div class="input-group col-sm-6" style="padding:5px ">
                <input class="form-control py-2 border-right-0 border" type="text" placeholder="ค้นหา ชื่อ-นามสกุล ชื่อCH username สถานะ และ เวลา... " id="searchbox">
                <span class="input-group-append">
                    <button class="btn btn-danger" type="button" readonly>
                        <i class="fa fa-search"></i>
                    </button>
                    <button class="btn btn-primary" id="showToday">
                        ดูเฉพาะวันนี้ <span class="badge badge-primary"></span>
                    </button>
                    <button class="btn btn-primary" id="showAll">
                        ดูทั้งหมด <span class="badge badge-primary"></span>
                    </button>
                </span>
            </div>
            <div id="result"></div>
            <div id="loader"></div>

        </div>
    </div>
</div> <!-- /container -->
<?php

require "footer.php";
?>