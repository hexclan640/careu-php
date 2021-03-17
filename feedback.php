<?php
require  "conn.php";


$lastID;
$type = $_POST['type'];
$userName = $_POST['userName'];
$feedbackMassage = $_POST['feedbackMassage'];
$time = $_POST['time'];
$requestId = $_POST['requestID'];
$time = strtotime($time);
// $newformat = date('Y-m-d', $time);
$time =  date('Y-m-d H:i:s.u:00:00+05:30', $time);

// $format = 'Y-m-!d H:i:s';
// $date = DateTime::createFromFormat($format, $time);
// $time = $date->format('Y-m-d H:i:s');

$mysql_qry = "INSERT INTO `feedback`( `feedbackTime`, `comment`) VALUES ('$time','$feedbackMassage')";
$mysql_qry_current_Id = "SELECT @@IDENTITY AS 'Identity'";

$mysql_qry_Id = "select userId from servicerequester where username like '$userName' and status like '1'";
$result = mysqli_query($conn, $mysql_qry_Id);
$row = $result->fetch_assoc();
$userId = (int) $row['userId'];
$requestId = (int)$requestId;

$mysql_qry_fb = "SELECT `feedbackId` FROM `give` WHERE `userId`=$userId AND `requestId`=$requestId";
$result_no_fb = mysqli_query($conn, $mysql_qry_fb);

if (mysqli_num_rows($result_no_fb) > 0) {
    
    echo ("Success fully Updated the feedback");
} else {
    if ($conn->query($mysql_qry) === TRUE) {
        $get_Id = mysqli_query($conn, $mysql_qry_current_Id);
        $fIdRow = $get_Id->fetch_assoc();
        $fId = (int)$fIdRow['Identity'];
        // echo ("Success fully saved the feedback");
        $mysql_qry_give = "INSERT INTO `give`(`requestId`, `feedbackId`, `userId`) VALUES ($requestId,$fId,$userId)";
        $result_give = mysqli_query($conn, $mysql_qry_give);
        echo ("Success fully saved the feedback");
    } else {
        echo "Error :" . $mysql_qry . "<br>" . $conn->error;
        // echo ("Success fully Not saved the feedback");
    }
}
