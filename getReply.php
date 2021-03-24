<?php
require 'conn.php';

$requestId = $_GET['requestId'];

$sql = "SELECT requestId FROM reply";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $status =0;
  while($row = $result->fetch_assoc()) {
    //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    
    if($row["requestId"] == $requestId){

        $product = array();
        $stmt = $conn->prepare("select message from reply where requestId = '$requestId'");
        $stmt->execute();

        $stmt->bind_result($message);

        if ($stmt->fetch()) {	

            $stmt->execute();

            while ($stmt->fetch()) {

                    $temp = array();
                    $temp['message']=$message;
                    array_push($product, $temp);
                }

                echo json_encode($product);

            # code...
        }else{
            echo "Still No request to show";

        }
        $status = 1;
    }
  }
}



?>