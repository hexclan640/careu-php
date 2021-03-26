<?php
require 'conn.php';

// $rqId = $_POST['requestId'];
$userName = $_GET['userName'];

$userIdQuery = "select userId from servicerequester where userName like '$userName'";
$result = mysqli_query($conn,$userIdQuery);
$row = $result->fetch_assoc();
$userId = (int)$row['userId'];


$allRq = $conn->prepare("SELECT message,requestId FROM reply WHERE userId='$userId' AND flag = '0' ORDER BY replyId DESC LIMIT 1 ");
$allRq->execute();

$product = array();

// $allRq->bind_result($requestId);
$allRq->bind_result($message,$requestId);

if ($allRq->fetch()) {	

	$allRq->execute();

	while ($allRq->fetch()) {

		$temp = array();
	 	//$temp['allRequest'] = $allRequest;
		//  $temp['replyId'] = $replyId;
		$temp['message'] = $message;
		$temp['requestId'] = $requestId;
	 	array_push($product, $temp);
	}

	//array_push($all,$product);

	echo json_encode($product);
	$query = "UPDATE reply SET flag = '1' WHERE flag = '0'";
	mysqli_query($conn,$query);
	# code...
}else{
	echo "Still No request to show";

}
?>