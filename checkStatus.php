<?php
require "conn.php";

$userName = $_POST['userName'];
$flagget = $_POST['flag'];
$userIdQuery = "select userId from servicerequester where userName like '$userName'";
$result = mysqli_query($conn, $userIdQuery);
$row = $result->fetch_assoc();
$userId = (int)$row['userId'];



$mysql_query_get_flag = "SELECT 1990ambulancerequest.requestId,1990ambulancerequest.flag FROM request INNER JOIN 1990ambulancerequest ON request.requestId= 1990ambulancerequest.requestId WHERE request.userId=78 ORDER BY 1990ambulancerequest.requestId DESC LIMIT 1";
$result = mysqli_query($conn, $mysql_query_get_flag);
$row = $result->fetch_assoc();
$flag = $row['flag'];
$requestId = $row['requestId'];

if ($flagget == "0") {
    if ($flag == 1) {
        echo "okey";
    } else {
        echo "Desline or time out";
    }
} else {
    $mysql_query_update_flag = "UPDATE `1990ambulancerequest` SET `flag`=3 WHERE `requestId` = $requestId";
    mysqli_query($conn, $mysql_query_update_flag);
}
