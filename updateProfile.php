<?php
require 'conn.php';

$username = $_POST['userName'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phoneNumber = $_POST['phoneNumber'];

$mysql_qry_relation = "select userId from servicerequester where username like '$username' and status like '1'";
$result = mysqli_query($conn, $mysql_qry_relation);
$row = $result->fetch_assoc();
$userId = (int) $row['userId'];


$mysql_query = "UPDATE servicerequester SET firstName='$firstName', lastName='$lastName',email='$email',phoneNumber='$phoneNumber' WHERE userId = $userId";

if (mysqli_query($conn, $mysql_query)) {
    echo "Record updated";
} else {
    echo $firstName . " Error updating record: " . mysqli_error($conn);
}



// echo "hello";
