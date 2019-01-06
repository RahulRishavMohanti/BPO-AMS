<?php
$q = ($_GET['q']);

include_once('connection.php');
$appr = "Approved";
$sql="UPDATE Expenses SET status='$appr' WHERE expenseID='$q'";
$result = mysqli_query($db,$sql);

echo "Approved";
mysqli_close($con);
?>