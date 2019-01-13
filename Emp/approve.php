<?php
$q = ($_GET['q']);

include_once('connection.php');
$appr = "Resolved";
$sql="UPDATE Ticket SET Status='$appr' WHERE ticketid='$q'";
$result = mysqli_query($db,$sql);

echo "Resolved";
mysqli_close($con);
?>