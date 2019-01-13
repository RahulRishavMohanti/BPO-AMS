<?php
$q = ($_GET['q']);

include_once('connection.php');
$appr = "Approved";
$sql="DELETE FROM locationList WHERE location='$q'";
$result = mysqli_query($db,$sql);

echo "Approved";
mysqli_close($con);
?>