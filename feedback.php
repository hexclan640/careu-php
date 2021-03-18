<?php
require  "conn.php";

$userName = $_GET['userName'];
$type = $_GET['type'];
$requestId = $_GET['requestID'];
$lastID;

$mysql_qry_Id = "select userId from servicerequester where username like '$userName' and status like '1'";
$result = mysqli_query($conn, $mysql_qry_Id);
$row = $result->fetch_assoc();
$userId = (int) $row['userId'];
$requestId = (int)$requestId;


if ($type == "0") {
    $mysql_qry_fb = "SELECT `feedbackId` FROM `give` WHERE `userId`=$userId AND `requestId`=$requestId";
    $result_no_fb = mysqli_query($conn, $mysql_qry_fb);
    $feedback =  array();
    $temp = array();
    if (mysqli_num_rows($result_no_fb) != 0) {
        $result_fb = mysqli_query($conn, $mysql_qry_fb);
        $row_fb = $result_fb->fetch_assoc();
        $feedbackId = (int)$row_fb['feedbackId'];
        $state = $conn->prepare("SELECT * FROM `careu`.`feedback` WHERE `feedbackId` = $feedbackId");
        $state->execute();
        $state->bind_result($feedbackId, $feedbacktime, $feedbackComment, $ratings);
        $state->fetch();
        $temp['feedbackId'] = $feedbackId;
        $temp['feedbackComment'] = $feedbackComment;
        $temp['ratings'] = $ratings;
        array_push($feedback, $temp);
        echo json_encode($feedback);
    } else {
        $temp['feedbackId'] = "Strill not a feedback";
        $temp['feedbackComment'] = "Add A feedback";
        array_push($feedback, $temp);
        echo json_encode($feedback);
    }
} else {
    $mysql_qry_fb = "SELECT `feedbackId` FROM `give` WHERE `userId`=$userId AND `requestId`=$requestId";
    $result_no_fb = mysqli_query($conn, $mysql_qry_fb);
    if (mysqli_num_rows($result_no_fb) != 0) {
        $feedbackMassage = $_POST['feedbackMassage'];
        $time = $_POST['time'];
        $time = strtotime($time);
        $time =  date('Y-m-d H:i:s', $time);
        $time = date("Y/m/d H:i:s", strtotime("+5 hours"));

        $rate = $_POST['rate'];
        $rate = floatval($rate);

        $result_fb = mysqli_query($conn, $mysql_qry_fb);
        $row_fb = $result_fb->fetch_assoc();
        $feedbackId = (int)$row_fb['feedbackId'];

        $mysql_qry_update_fb = "UPDATE feedback SET feedbackTime='$time',comment='$feedbackMassage',ratings=$rate WHERE feedbackId= $feedbackId";
        if ($conn->query($mysql_qry_update_fb) === TRUE) {
            echo ("Success fully Updated the feedback");
        } else {
            echo "Error :" . $mysql_qry_update_fb . "<br>" . $conn->error;
        }
    } else if (mysqli_num_rows($result_no_fb) == 0) {

        $feedbackMassage = $_POST['feedbackMassage'];
        $time = $_POST['time'];
        $time = strtotime($time);
        $time =  date('Y-m-d H:i:s', $time);
        $time = date("Y/m/d H:i:s", strtotime("+5 hours"));
        $rate = $_POST['rate'];
        $rate = (float)$rate;
        $mysql_qry = "INSERT INTO `feedback`( `feedbackTime`, `comment`,`ratings`) VALUES ('$time','$feedbackMassage',$rate)";
        $mysql_qry_current_Id = "SELECT @@IDENTITY AS 'Identity'";

        if ($conn->query($mysql_qry) === TRUE) {
            $get_Id = mysqli_query($conn, $mysql_qry_current_Id);
            $fIdRow = $get_Id->fetch_assoc();
            $fId = (int)$fIdRow['Identity'];
            $mysql_qry_give = "INSERT INTO `give`(`requestId`, `feedbackId`, `userId`) VALUES ($requestId,$fId,$userId)";
            $result_give = mysqli_query($conn, $mysql_qry_give);
            echo ("Successfully saved the feedback");
        } else {
            echo "Error :" . $mysql_qry . "<br>" . $conn->error;
        }
    }
}
