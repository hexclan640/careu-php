<?php
require  "conn.php";

$qry="select * from instruction3";

$raw=mysqli_query($conn,$qry);

while($res=mysqli_fetch_array($raw))
{
	 $data[]=$res;
}
print(json_encode($data));
?>