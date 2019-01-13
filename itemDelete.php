<?php
$q = ($_GET['q']);

include_once('connection.php');
$appr = "Approved";
$sql="DELETE FROM itemList WHERE item='$q'";
$result = mysqli_query($db,$sql);

echo "Approved";
mysqli_close($con);
?>