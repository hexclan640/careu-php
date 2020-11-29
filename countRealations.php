<?php
require  "conn.php";
 $userName = $_GET['userName'];
 // $username="1599";

 $stmt = $conn->prepare(" SELECT servicerequester.userName ,servicerequester.firstName, servicerequester.lastName,servicerequester.email,servicerequester.phoneNumber,servicerequester.nicNumber ,relative.name as 'relative', relative.phoneNumber as 'relativeNumber'  FROM servicerequester INNER JOIN relative ON servicerequester.userId=relative.userId WHERE userName='$userName' AND status ='1';");
 
 $stmt->execute();

	$number = 0;
 	while ($stmt->fetch()) {
 		$number++;
 	}

if ($number>=3) {
	echo "you have alreay added all the Number of Relations";
	return;
}else{
	$rest = 3-$number;
	echo "You can add " .$rest. " Relations";
}