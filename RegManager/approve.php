<?php
$q = ($_GET['q']);
$inp = explode(".",$q);
include_once('connection.php');
$appr = "Approved";
$sql="UPDATE Expenses SET status='$appr',remark='$inp[1]' WHERE expenseID='$inp[0]'";
$result = mysqli_query($db,$sql);

echo "Approved";
mysqli_close($con);
?>