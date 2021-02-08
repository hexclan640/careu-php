<?php 

/*$host ='localhost';
$user ='root';
$pwd ='';
$db ='contacts';

$conn = mysqli_connect($host,$user,$pwd,$db);*/
$userName = $_GET['userName'];
echo $_GET['userName'];

require  "conn.php";
//$userName = $_GET['userName'];
//$userId=$_GET['userId'];


/*if(!$conn){

	die("Error in connection:" . mysqli_connect_error());
}*/

$response = array();

//$sql_query ="select * from relative";
$sql_query =" SELECT * FROM relative";


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