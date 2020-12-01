<?php
require  "conn.php";

$userName = $_GET['userName'];

$userIdQuery = "select userId from servicerequester where userName like '$userName'";
$result = mysqli_query($conn,$userIdQuery);
$row = $result->fetch_assoc();
$userId = (int)$row['userId'];


// $qry="SELECT request.date ,request.time , request.type , 1990ambulancerequest.numberOfPatients ,description FROM request INNER JOIN 1990ambulancerequest ON request.requestId = 1990ambulancerequest.requestId WHERE request.userId = '$userId'";


$stmt = $conn->prepare(" SELECT request.date ,request.time , request.type , 1990ambulancerequest.numberOfPatients ,description FROM request INNER JOIN 1990ambulancerequest ON request.requestId = 1990ambulancerequest.requestId WHERE request.userId = '$userId';");
 $stmt->execute();
$product = array();

$stmt->bind_result($date,$time,$type,$numberOfPatients,$description);

if ($stmt->fetch()) {	

	$stmt->execute();

	while ($stmt->fetch()) {

		 	$temp = array();
		 	$temp['date'] = $date;
		 	$temp['time'] = $time;
		 	$temp['type'] = $type;
		 	$temp['numberOfPatients'] = $numberOfPatients;
		 	$temp['description'] = $description;
		 	array_push($product, $temp);
		 }



		echo json_encode($product);

	# code...
}else{
	echo "Still No request to show";

}





// print(json_encode($data));
?>