<?php 
require  "conn.php";
$userName = $_GET['userName'];

// $stmt = $conn->prepare("SELECT userName, firstName,lastName,email,phoneNumber ,nicNumber FROM servicerequester WHERE userName='$userName';");

$stmt = $conn->prepare(" SELECT servicerequester.userName ,servicerequester.firstName, servicerequester.lastName,servicerequester.email,servicerequester.phoneNumber,servicerequester.nicNumber ,relative.name as 'relative', relative.phoneNumber as 'relativeNumber'  FROM servicerequester INNER JOIN relative ON servicerequester.userId=relative.userId WHERE userName='$userName' AND status ='1';");

 	 $stmt->execute();
$product = array();
 if ($stmt->fetch()) {
 		$stmt->execute();
 		$stmt->bind_result($userName,$firstName,$lastName,$email,$phoneNumber,$nicNumber,$relative,$relativeNumber);
 			$num = 1;
		 	while ($stmt->fetch()) {
		 	$temp = array();
		 	$temp['userName'] = $userName;
		 	$temp['firstName'] = $firstName;
		 	$temp['lastName'] = $lastName;
		 	$temp['email'] = $email;
		 	$temp['phoneNumber'] = $phoneNumber;
		 	$temp['nicNumber']=$nicNumber;
		 	$temp['relative'] = $relative;
		 	$temp['relativeNumber'] = $relativeNumber;
		 	$temp['type']='1';
		 	$temp['num'] = $num;
		 	$num = $num+1;
		 	array_push($product, $temp);
		 }
		 if ($num==2) {
		 	array_push($product, $temp);
		 	array_push($product, $temp);
		 }elseif ($num==3) {
		 	array_push($product, $temp);
		 }
		 


 }else {

 	 	$remp = $conn->prepare("SELECT userName, firstName,lastName,email,phoneNumber ,nicNumber FROM servicerequester WHERE userName='$userName';");
 	
 		$remp->execute();
 	 	$remp->bind_result($userName,$firstName,$lastName,$email,$phoneNumber,$nicNumber);

 	 while ($remp->fetch()) {
		 	$temp = array();
		 	$temp['userName'] = $userName;
		 	$temp['firstName'] = $firstName;
		 	$temp['lastName'] = $lastName;
		 	$temp['email'] = $email;
		 	$temp['phoneNumber'] = $phoneNumber;
		 	$temp['nicNumber']=$nicNumber;
		 	$temp['relative'] = "No-relatives";
		 	$temp['relativeNumber'] = "No-relatives";
		 	$temp['num'] = 0;
		 	array_push($product, $temp);
		 }
		 array_push($product, $temp);
		 array_push($product, $temp);
 }
 

// $product = array();

// while ($remp->fetch()) {
//  	$temp = array();
//  	$temp['userName'] = $userName;
//  	$temp['firstName'] = $firstName;
//  	$temp['lastName'] = $lastName;
//  	$temp['email'] = $email;
//  	$temp['phoneNumber'] = $phoneNumber;
//  	$temp['nicNumber']=$nicNumber;
//  	$temp['relative'] = $relative;
//  	array_push($product, $temp);
//  }
echo json_encode($product);


?>