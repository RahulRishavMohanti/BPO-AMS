<?php
$q = ($_GET['q']);

include_once('connection.php');
$appr = "Approved";
$sql="INSERT INTO locationList values('$q')";
$result = mysqli_query($db,$sql);
if($result)
{
	echo "success";
}
else
{
	echo "fail";
}
mysqli_close($con);
?>