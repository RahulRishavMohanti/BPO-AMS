<?php
$q = ($_GET['q']);

include_once('connection.php');
$appr = "Approved";
$sql="SELECT remark from expenses WHERE expenseID='$q' limit 1";
$result = mysqli_query($db,$sql);
if($result) {
		$row = mysqli_fetch_row($result);
		$remark = $row[0];
	}
echo $remark;
mysqli_close($con);
?>