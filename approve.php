<?php
$q = ($_GET['q']);

$db = mysqli_connect("localhost", "root", "root", "loginapp",8889) or die ("Failed to connect");
$appr = "Approved";
$sql="UPDATE Expenses SET status='$appr' WHERE expenseID='$q'";
$result = mysqli_query($db,$sql);

echo "Approved";
mysqli_close($con);
?>