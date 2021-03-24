<?php
require 'conn.php';

$rqId = $_POST['requestId'];
if($rqId == "ignore"){
    echo 'ignore';
}else{

    $sql = "select flag from 119policerequest where requestId = '$rqId'";
    $res = mysqli_query($conn,$sql);
    $row = $res->fetch_assoc();
    $flag = (int)$row['flag'];

    if($flag==2){
        echo 'rejected';
    }elseif($flag==1){
        echo 'accepted';
    }elseif($flag==0){
        echo 'not viewed';
    }
}


?>