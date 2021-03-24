<?php
require 'conn.php';

// $rqId = $_POST['requestId'];
$userName = $_GET['userName'];

$userIdQuery = "select userId from servicerequester where userName like '$userName'";
$result = mysqli_query($conn,$userIdQuery);
$row = $result->fetch_assoc();
$userId = (int)$row['userId'];

$stmt = $conn->prepare("SELECT request.requestId FROM request INNER JOIN 119policerequest ON request.requestId = 119policerequest.requestId WHERE request.userId = '$userId' AND 119policerequest.flag = 0");
$stmt->execute();
$product = array();

$stmt->bind_result($requestId);

if ($stmt->fetch()) {	

	$stmt->execute();

	while ($stmt->fetch()) {

		 	$temp = array();
		 	$temp['requestId'] = $requestId;
		 	array_push($product, $temp);
		 }



		echo json_encode($product);

	# code...
}else{
	echo "Still No request to show";

}

?>
