<?php 

require  "conn.php";
$userName = $_GET['userName'];


$response = array();



//$sql_query ="SELECT * FROM relative WHERE userName like '$userName'";

$sql_query1="SELECT userId FROM servicerequester WHERE userName like '$userName' and status like '1'";

$result = mysqli_query($conn,$sql_query1);
	$row=$result->fetch_assoc();
	$userId = (int) $row['userId'];

	$sql_query="SELECT * FROM relative WHERE userId like '$userId'";



$result =mysqli_query($conn,$sql_query);

if (mysqli_num_rows($result)>0) {
	$response['success']=1;
	$cars=array();
	while($row=mysqli_fetch_assoc($result)){
          
          array_push($cars,$row);
	}
	$response['cars']=$cars;
	# code...
}
else{

	$response['success'] =0;
	$response['message'] ='No data';
}

echo json_encode($response);

mysqli_close($conn);
 ?>