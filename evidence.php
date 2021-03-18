<?php

//require "registerApp.php";

$user_name = "root";
$user_pass = "";
$host_name = "localhost";
$db_name = "careu";

$conn = mysqli_connect($host_name,$user_name,$user_pass,$db_name);

if($conn){
    $image = $_POST['image'];
    $time = $_POST["time"];
    $date = $_POST["date"];
    $category = $_POST["category"];
    $userName = $_POST["userName"];
    
    $qry = "select userId from servicerequester where username like '$userName'";
    $result = mysqli_query($conn,$qry);
    $row = $result->fetch_assoc();
    $id = (int) $row['userId'];

    $requestQuery = "select requestId from request where userId like '$id' AND time like '$time' AND date like '$date'";
    $reqResult = mysqli_query($conn,$requestQuery);
    $reqRow = $reqResult->fetch_assoc();
    $reqId = (int) $reqRow['requestId'];
    chdir("evidence");
    mkdir($reqId);
    

    //$upload_path = "evidence/$folder/$userName.jpg";

    $now = DateTime::createFromFormat('U.u',microtime(true));
    $eviName = $now->format('YmdHisu');
    $sql = "insert into photo(name,time,date,category,requestId) values ('$eviName','$time','$date','$category','$reqId')";
    $upload_path = "$reqId/$eviName.jpg";
    if(mysqli_query($conn,$sql)){
        // mysqli_query($conn,$sql);
        file_put_contents($upload_path,base64_decode($image));
        
        echo json_encode(array('response'=>'image uploaded successfully'));
    }
    else{
        echo json_encode(array('response' => 'Image upload failed'));
    }
}
else{
    echo json_encode(array('response'=>'connection fail'));
}

// make changess
?>