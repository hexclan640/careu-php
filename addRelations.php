<?php
require  "conn.php";
 $username = $_POST['username'];
 // $username="1599";

 $stmt = $conn->prepare(" SELECT servicerequester.userName ,servicerequester.firstName, servicerequester.lastName,servicerequester.email,servicerequester.phoneNumber,servicerequester.nicNumber ,relative.name as 'relative', relative.phoneNumber as 'relativeNumber'  FROM servicerequester INNER JOIN relative ON servicerequester.userId=relative.userId WHERE userName='$username' AND status ='1';");
 
 $stmt->execute();

	$number = 0;
 	while ($stmt->fetch()) {
 		$number++;
 	}



if ($number<3) {
	# code...


	$mysql_qry_relation = "select userId from servicerequester where username like '$username' and status like '1'";
	$result = mysqli_query($conn,$mysql_qry_relation);
	$row=$result->fetch_assoc();
	$userId = (int) $row['userId'];

	$relative1 = $_POST['relative1'];
	$relative1Number = $_POST['relative1Number'];
	// $relative1 = "Damish";
	// $relative1Number = "0776560118";
	$flag = 0;
	if($relative1Number != NULL && $relative1 !=NULL){
		$mysql_query = "insert into relative (userId,name,phoneNumber) values ($userId,'$relative1','$relative1Number')";
		$conn->query($mysql_query);
		// if($conn->query($mysql_query) === TRUE){
		//     echo "relative1";
		// }
		// else{
		//     echo "Error :".$mysql_query."<br>".$conn->error;
		// } 
		$flag++;
		echo "Sucessfully add the Relatives";

		}else{

		echo "username and phoneNumber cannot be empty";


		}

		// $relative2 = $_POST['relative2'];
		// $relative2Number = $_POST['relative2Number'];

	// if($relative2Number != NULL){
	// 	$mysql_query = "insert into relative (userId,name,phoneNumber) values ($userId,'$relative2','$relative2Number')";
	// 	$conn->query($mysql_query);
	// 	// if($conn->query($mysql_query) === TRUE){
	// 	//     echo "relative1";
	// 	// }
	// 	// else{
	// 	//     echo "Error :".$mysql_query."<br>".$conn->error;
	// 	// } 
	// 	$flag++;
	// 	}

	// 	$relative3 = $_POST['relative3'];
	// 	$relative3Number = $_POST['relative3Number'];

	// if($relative3Number != NULL){
	// 	$mysql_query = "insert into relative (userId,name,phoneNumber) values ($userId,'$relative3','$relative3Number')";
	// 	$conn->query($mysql_query);
	// 	// if($conn->query($mysql_query) === TRUE){
	// 	//     echo "relative1";
	// 	// }
	// 	// else{
	// 	//     echo "Error :".$mysql_query."<br>".$conn->error;
	// 	// }
	// 	$flag++; 
	// 	}
		

	
}else {
	echo "Allready You filled up all the relations";	

}

?>