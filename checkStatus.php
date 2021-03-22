<?php
require "conn.php";

$userName = $_POST['userName'];
$userIdQuery = "select userId from servicerequester where userName like '$userName'";
$result = mysqli_query($conn, $userIdQuery);
$row = $result->fetch_assoc();
$userId = (int)$row['userId'];

echo "okey";
