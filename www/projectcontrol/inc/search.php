<?php
require "connect.php";
date_default_timezone_set('asia/bangkok');
$strDate = date("Y-m-d H:i:s", mktime(date("H"), date("i") + 0, date("s") + 0, date("m") + 0, date("d") - 1, date("Y") + 0));
//echo $startstrDate . ' LAST ' . $laststrDate;

if (!(isset($_GET['pageNumber']))) {
    $pageNumber = 1;
} else {
    $pageNumber = $_GET['pageNumber'];
}

$perPageCount = 10;

$lowerLimit = ($pageNumber - 1) * $perPageCount;

$keyupsearch = $_GET['keyup'];
$showAll = $_GET['showAll'];

if ($showAll == 1) {

    $sqlsearch = "SELECT  control.statusdevice,control.datecontrol,channel.channelname,
    users.username,users.fname,users.lname
     FROM control 
     INNER JOIN channel 
    ON channel.channelid = control.channelid
    INNER JOIN users
    ON users.userid = control.userid
WHERE (users.username
LIKE '%$keyupsearch%'
OR channel.channelname
LIKE '%$keyupsearch%'
OR users.fname
LIKE '%$keyupsearch%'
OR users.lname
LIKE '%$keyupsearch%'
OR control.statusdevice
LIKE '%$keyupsearch%'
OR control.datecontrol
LIKE '%$keyupsearch%')
ORDER BY control.datecontrol DESC LIMIT {$lowerLimit} , {$perPageCount}";
    $resultsearch = mysqli_query($con, $sqlsearch);
    if (mysqli_num_rows($resultsearch) >= 1) {
        $output .= '<div class="container">
         <table class="table table-hover">
        <thead>
            <tr class="table-light">
            <th scope="col">ชื่อแชแนล</th>
            <th scope="col">Username</th>
            <th scope="col">ชื่อ-นามสกุล</th>
            <th scope="col">สถานะควบคุม</th>
            <th scope="col">วันที่</th>
            </tr>
            </thead>
            <tbody>';
        $count = ($pageNumber - 1) * $perPageCount + 1;
        while ($row = mysqli_fetch_array($resultsearch)) {
            $output .= '
            <tr class= table-light>
                <td>' . $row['channelname'] . '</td>
                <td>' . $row['username'] . '</td>
                <td>' . $row['fname'] . " " . $row['lname'] . '</td>';
            if ($row['statusdevice'] == "ON") {
                $output .= '<td><h2 class="btn btn-success">' . $row['statusdevice'] . '</td>';
            }
            if ($row['statusdevice'] == "OFF") {
                $output .= '<td><h2 class="btn btn-danger">' . $row['statusdevice'] . '</h2></td>';
            }
            $output .= '<td>' . $row['datecontrol'] . '</td>
				
			</tr>
		';
        }
        $output .= ' 
            </tbody>
            </table>';


        $sql2 = "SELECT control.statusdevice,control.datecontrol,channel.channelname,
        users.username,users.fname,users.lname
        FROM control 
        INNER JOIN channel 
       ON channel.channelid = control.channelid
       INNER JOIN users
    ON users.userid = control.userid
    WHERE  (users.username
LIKE '%$keyupsearch%'
OR channel.channelname
LIKE '%$keyupsearch%'
OR users.fname
LIKE '%$keyupsearch%'
OR users.lname
LIKE '%$keyupsearch%'
OR control.statusdevice
LIKE '%$keyupsearch%'
OR control.datecontrol
LIKE '%$keyupsearch%')";
        $query2 = mysqli_query($con, $sql2);
        $rowCount = mysqli_num_rows($query2);
        $pagesCount = ceil($rowCount  / $perPageCount);

        $output .= "
        <div class='nav-scroller py-10 mb-10'> 
        <nav class='nav d-flex '>
        <ul class='pagination pagination-sm flex-sm-wrap'>
        <li class='page-item'> <button class='btn btn-outline-primary' onclick='showRecords($perPageCount, 1 ,\"$keyupsearch\", \"$showAll\")' aria-label='Previous'>
                    <span aria-hidden='true'><i class='fa fa-arrow-left'></i>
                    </span>
                    </button>
               </li>

            ";
        for ($i = 1; $i <= $pagesCount; $i++) {
            if ($i == $pageNumber) {
                $output .= "

                <li class='page-item'> <button class='btn btn-primary' onclick='showRecords($perPageCount,$i,\"$keyupsearch\", \"$showAll\")'>$i</button></li>
                ";
            } else {
                $output .= "

                <li class='page-item'> <button class='btn btn-outline-primary' onclick='showRecords($perPageCount,$i,\"$keyupsearch\", \"$showAll\")'>$i </button></li>
                ";
            }
        }
        $output .= "
        <li class='page-item'><button class='btn btn-outline-primary' onclick='showRecords($perPageCount , $pagesCount ,\"$keyupsearch\", \"$showAll\")'aria-label='Next'>
        <span aria-hidden='true'><i class='fa fa-arrow-right'></i></span></button>
    </li>
    <h6 style='color:white;'>Page $pageNumber  of $pagesCount </h6>
    </ul> 
    </nav> 
    </div>

</div>
    ";
        echo $output;
    } else {
        echo "<h1 style='color:white; text-align:center;'>ไม่มีข้อมูล</h1>";
    }
    mysqli_close($con);
}
if ($showAll == 0) {

    $sqlsearch = "SELECT  control.statusdevice,control.datecontrol,channel.channelname,
    users.username,users.fname,users.lname
     FROM control 
     INNER JOIN channel 
    ON channel.channelid = control.channelid
    INNER JOIN users
    ON users.userid = control.userid
    WHERE (control.datecontrol >= '$strDate')
AND (users.username
LIKE '%$keyupsearch%'
OR channel.channelname
LIKE '%$keyupsearch%'
OR users.fname
LIKE '%$keyupsearch%'
OR users.lname
LIKE '%$keyupsearch%'
OR control.statusdevice
LIKE '%$keyupsearch%'
OR control.datecontrol
LIKE '%$keyupsearch%')
ORDER BY control.datecontrol DESC LIMIT {$lowerLimit} , {$perPageCount}";
    $resultsearch = mysqli_query($con, $sqlsearch);
    if (mysqli_num_rows($resultsearch) >= 1) {
        $output .= '<div class="container">
         <table class="table table-hover">
        <thead>
            <tr class="table-light">
            <th scope="col">ชื่อแชแนล</th>
            <th scope="col">Username</th>
            <th scope="col">ชื่อ-นามสกุล</th>
            <th scope="col">สถานะควบคุม</th>
            <th scope="col">วันที่</th>
            </tr>
            </thead>
            <tbody>';
        $count = ($pageNumber - 1) * $perPageCount + 1;
        while ($row = mysqli_fetch_array($resultsearch)) {
            $output .= '
            <tr class= table-light>
                <td>' . $row['channelname'] . '</td>
                <td>' . $row['username'] . '</td>
                <td>' . $row['fname'] . " " . $row['lname'] . '</td>';
            if ($row['statusdevice'] == "ON") {
                $output .= '<td><h2 class="btn btn-success">' . $row['statusdevice'] . '</td>';
            }
            if ($row['statusdevice'] == "OFF") {
                $output .= '<td><h2 class="btn btn-danger">' . $row['statusdevice'] . '</h2></td>';
            }
            $output .= '<td>' . $row['datecontrol'] . '</td>
				
			</tr>
		';
        }
        $output .= ' 
            </tbody>
            </table>';


        $sql2 = "SELECT control.statusdevice,control.datecontrol,channel.channelname,
        users.username,users.fname,users.lname
        FROM control 
        INNER JOIN channel 
       ON channel.channelid = control.channelid
       INNER JOIN users
    ON users.userid = control.userid
    WHERE (control.datecontrol >= '$strDate')
AND (users.username
LIKE '%$keyupsearch%'
OR channel.channelname
LIKE '%$keyupsearch%'
OR users.fname
LIKE '%$keyupsearch%'
OR users.lname
LIKE '%$keyupsearch%'
OR control.statusdevice
LIKE '%$keyupsearch%'
OR control.datecontrol
LIKE '%$keyupsearch%')";
        $query2 = mysqli_query($con, $sql2);
        $rowCount = mysqli_num_rows($query2);
        $pagesCount = ceil($rowCount  / $perPageCount);

        $output .= "
        <div class='nav-scroller py-1 mb-2'> 
        <nav class='nav d-flex '>
        <ul class='pagination pagination-sm flex-sm-wrap' style=' word-wrap: break-word;'>
        <li class='page-item'> <button class='btn btn-outline-primary' onclick='showRecords($perPageCount, 1 ,\"$keyupsearch\", \"$showAll\")' aria-label='Previous'>
                    <span aria-hidden='true'><i class='fa fa-arrow-left'></i>
                    </span>
                    </button>
               </li>
         
           
            ";
        for ($i = 1; $i <= $pagesCount; $i++) {
            if ($i == $pageNumber) {
                $output .= "

           
                <li class='page-item'> <button class='btn btn-primary' onclick='showRecords($perPageCount,$i,\"$keyupsearch\", \"$showAll\")'>$i</button></li>
              
                ";
            } else {
                $output .= "

            
                <li class='page-item'> <button class='btn btn-outline-primary' onclick='showRecords($perPageCount,$i,\"$keyupsearch\", \"$showAll\")'>$i </button></li>
           
                ";
            }
        }
        $output .= "
        <li class='page-item'><button class='btn btn-outline-primary' onclick='showRecords($perPageCount , $pagesCount ,\"$keyupsearch\", \"$showAll\")'aria-label='Next'>
        <span aria-hidden='true'><i class='fa fa-arrow-right'></i></span></button>
    </li>
    <h6 style='color:white;'>Page $pageNumber  of $pagesCount </h6>
    </ul> 
    </nav> 
    </div>
</div>
    ";
        echo $output;
    } else {
        echo "<h1 style='color:white; text-align:center;'>ไม่มีข้อมูล</h1>";
    }
    mysqli_close($con);
}
