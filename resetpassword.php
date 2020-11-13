<?php
	require  "conn.php";

	$userName = $_GET['userName'];
	// echo $username;
	$sql = "select * from servicerequester where userName = '$userName'";
	$result = mysqli_query($conn,$sql);
	$no = mysqli_num_rows($result);
	// echo $no;
	if (mysqli_num_rows($result)===1) {
		
		if (isset($_POST['submit'])) {
		$userName = $_GET['userName'];
	// echo $username;
		// $sql = "select username from androidreg where username = '$username' ";
		// $result = mysqli_query($conn,$sql);
		// $no = mysqli_num_rows($result);
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];
		// echo $password;
		// echo $cpassword;
		if ($password  == "" || $cpassword =="") {
			echo "Cannot empty Feilds";
		}else{
			if ( $password === $cpassword ){


				$update = "update servicerequester set password = '$password' where username = '$userName'";
				mysqli_query($conn,$update);

				echo "Changed password";
			} else{
				echo("NOT MATCHING Passwords");
			}
		}
		
	}



	}else{
		echo "string";
	}



	// if (isset($_POST['submit'])) {
	// 	$username = $_GET['username'];
	// // echo $username;
	// 	$sql = "select username from androidreg where username = '$username' ";
	// 	$result = mysqli_query($conn,$sql);
	// 	$no = mysqli_num_rows($result);
	// 	$password = $_POST['password'];
	// 	$cpassword = $_POST['cpassword'];
	// 	// echo $password;
	// 	// echo $cpassword;
	// 	if ($password  == "" || $cpassword =="") {
	// 		echo "Cannot empty Feilds";
	// 	}else{
	// 		if ( $password === $cpassword ){


	// 			$update = "update androidreg set password = '$password' where username = '$username'";
	// 			mysqli_query($conn,$update);

	// 			echo "Changed password";
	// 		} else{
	// 			echo("NOT MATCHING Passwords");
	// 		}
	// 	}
		
	// }




?>


<!DOCTYPE html>
<html>
<head>
	<title>Forget password</title>
</head>
<body>
	<form action="" method="POST">
		<h3><?php echo $userName ?></h3>
		
		Enter New Password : <input type="password" name="password"> <br>
		Confirm Password : <input type="password" name="cpassword">
		<input type="submit" name="submit">
	</form>


</body>
</html>