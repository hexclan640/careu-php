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
		$password = md5($_POST['password']);
		// $cpassword = $_POST['cpassword'];
		// echo $password;
		// // echo $cpassword;
		// if ($password  == "" || $cpassword =="") {
		// 	echo "Cannot empty Feilds";
		// }else{
		// 	if ( $password === $cpassword ){


				$update = "update servicerequester set password = '$password' where username = '$userName'";
				$result=mysqli_query($conn,$update);

				// echo "Changed password";
				if($result)
				{
					header("Location: http://localhost/careu-php/saved.php");
				}
				else
				{
					echo "failed";
				}
				
		// 	} else{
		// 		echo("NOT MATCHING Passwords");
		// 	}
		// }
		
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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/jpg" href="images/appLogo.png">
	<link rel="stylesheet" type="text/css" href="css/resetPassword.css">
	<title>Change Password</title>
</head>
<body>
	<div class="form">
		<img src="images/appLogo.png" class="logo">
		<center>
			<div class="appname">
				<p class="name1"><b>care</b></p><p class="name2"><b>U</b></p>
			</div>
			<div class="loginform">
				<p class="hide" id="err">Error</p>
				<form action="" method="post">
					<input type="password" id="password" name="password" placeholder="New password"><br>
					<input type="password" id="cpassword" name="cpassword" placeholder="Confirm password"><br><br>
	    			<input type="submit" value="SAVE" onclick="return check()" name="submit" id="submit"><br><br>
	 			</form>
			</div>
		</center>
	</div>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/validate.js"></script>
</body>
</html>