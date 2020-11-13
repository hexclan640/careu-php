<?php
require 'conn.php';

$type = $_POST['type'];
$userName = $_POST['userName'];
$date = $_POST['date'];
$time = $_POST['time'];
$district = $_POST['district'];
$policeStation = $_POST['policeStation'];
$noOfPatients = $_POST['noOfPatients'];
$description = $_POST['description'];


// $toDate = strtotime($date);
// $cDate = date('Y-m-d',$toDate);


$userIdQuery = "select userId from servicerequester where userName like '$userName'";
$result = mysqli_query($conn,$userIdQuery);

if(mysqli_num_rows($result)>0){
    $row = $result->fetch_assoc();
    $userId = (int)$row['userId'];

    // $date = date(Y-m-d,$d);
    
    // $cDate = "2";
    // $time = "10";
    $request = "insert into request(date,time,userId,type) values('$date','$time','$userId','$type')";
    $requestResult = mysqli_query($conn,$request);    //insert in to request table

    $getRequestId = "select requestId,type from request where userId like '$userId' AND date like '$date' AND time like '$time' ";
    $requestIdResult = mysqli_query($conn,$getRequestId);
    if(mysqli_num_rows($requestIdResult)>0){
        $amRow = $requestIdResult->fetch_assoc();
        $requestId = (int)$amRow['requestId']; 
        $requestType = (String)$amRow['type'];


        if($type == "ambulance"){
        $ambulanceRequest = "insert into 1990ambulancerequest(requestId,date,time,district,policeStation,numberOfPatients,description) 
                                values('$requestId','$date','$time','$district','$policeStation','$noOfPatients','$description')";
        mysqli_query($conn,$ambulanceRequest);
        }
        echo 'Request send';

    }else{
        echo 'can not get request Id';
    }



}else{
    echo 'can not find the user';
}




?>