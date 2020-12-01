<?php
require "conn.php";

$username = $_POST['userName'];
$password = md5($_POST['password']);
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$nicNumber = $_POST['nicNumber'];
// $gender = $_POST['gender'];
$email = $_POST['email'];
$address = $_POST['address'];
// $dateOfBirth = $_POST['dateOfBirth'];
$phoneNumber = $_POST['phoneNumber'];
$gender = $_POST['gender'];

$dbday = $_POST['dateOfBirth'];
$time = strtotime($dbday);
// $newformat = date('Y-m-d',$time);
$dateOfBirth =  date('Y-m-d',$time);

$mysql_qry = "select * from servicerequester where username like '$username' and (status = '1' or status ='0') ";

$result = mysqli_query($conn,$mysql_qry);

if (mysqli_num_rows($result)>0) {
	echo "Already Used User_name please use another one";
}else{
	$mysql_qry = "select * from serviceRequester where  nicNumber like '$nicNumber' and (status = '1' or status ='0')";
	$result = mysqli_query($conn,$mysql_qry);
		if (mysqli_num_rows($result)>0) {
			echo "Already Created Account using this ID";
		}else{
			$mysql_qry = "insert into serviceRequester (userName,password,firstName,lastName,nicNumber,gender,email,address,dateOfBirth,phoneNumber)
               values ('$username','$password','$firstName','$lastName','$nicNumber','$gender','$email','$address','$dateOfBirth','$phoneNumber')";
               		// mysqli_query($conn,$mysql_qry);

					if($conn->query($mysql_qry) === TRUE){

						// $mysql_qry_relation = "select userId from servicerequester where username like '$username' ";
						// $result = mysqli_query($conn,$mysql_qry_relation);
						// $row=$result->fetch_assoc();
						// $userId = (int) $row['userId'];

						// 	$relative1 = $_POST['relative1'];
						// 	$relative1Number = $_POST['relative1Number'];

						// 	if($relative1Number != NULL){
						// 		$mysql_query = "insert into relative (userId,name,phoneNumber) values ($userId,'$relative1','$relative1Number')";
						// 		$conn->query($mysql_query);
						// 				// if($conn->query($mysql_query) === TRUE){
						// 				//     echo "relative1";
						// 				// }
						// 				// else{
						// 				//     echo "Error :".$mysql_query."<br>".$conn->error;
						// 				// } 

						// 	}

						// 	$relative2 = $_POST['relative2'];
						// 	$relative2Number = $_POST['relative2Number'];

						// 	if($relative2Number != NULL){
						// 		$mysql_query = "insert into relative (userId,name,phoneNumber) values ($userId,'$relative2','$relative2Number')";
						// 		$conn->query($mysql_query);
						// 				// if($conn->query($mysql_query) === TRUE){
						// 				//     echo "relative1";
						// 				// }
						// 				// else{
						// 				//     echo "Error :".$mysql_query."<br>".$conn->error;
						// 				// } 

						// 	}

						// 	$relative3 = $_POST['relative3'];
						// 	$relative3Number = $_POST['relative3Number'];

						// 	if($relative3Number != NULL){
						// 		$mysql_query = "insert into relative (userId,name,phoneNumber) values ($userId,'$relative3','$relative3Number')";
						// 		$conn->query($mysql_query);
						// 				// if($conn->query($mysql_query) === TRUE){
						// 				//     echo "relative1";
						// 				// }
						// 				// else{
						// 				//     echo "Error :".$mysql_query."<br>".$conn->error;
						// 				// } 

						// 	}

					    echo "Registration successful";
					}
					else{
					    echo "Error :".$mysql_qry."<br>".$conn->error;
					} 


		}

}


// $mysql_qry = "select userId from servicerequester where username like '$username' ";

// $result = mysqli_query($conn,$mysql_qry);
// $row=$result->fetch_assoc();
// $userId = (int) $row['userId'];

 // echo $id;

// $relative1 = $_POST['relative1'];
// $relative1Number = $_POST['relative1Number'];


// 		$mysql_query = "insert into relative (userId,name,phoneNumber) values ($userId,'$relative1','$relative1Number')";
// 		if($conn->query($mysql_query) === TRUE){
// 					    echo "It on this spot 2";
// 					}
// 					else{
// 					    echo "Error :".$mysql_query."<br>".$conn->error;
// 					} 


	





// $mysql_qry = "insert into serviceRequester (userName,password,firstName,lastName,nicNumber,gender,email,address,dateOfBirth,phoneNumber)
//                values ('$username','$password','$firstName','$lastName','$nicNumber','$gender','$email','$address','$dateOfBirth','$phoneNumber')";
// if($conn->query($mysql_qry) === TRUE){
//     echo "Registration successful";
// }
// else{
//     echo "Error :".$mysql_qry."<br>".$conn->error;
// } 
$conn->close();
?>