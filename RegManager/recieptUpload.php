<?php

if(!empty($_POST['remark']) || !empty($_POST['expenseID']))
{

$appr = "Approved";
$rem = $_POST['remark'];
$expID = $_POST['expenseID'];
$sql="UPDATE Expenses SET status='$appr',remark='$rem' WHERE expenseID='$expID'";
 
//include database configuration file
include_once 'connection.php';
$result = mysqli_query($db,$sql);

} 
else 
{
echo 'invalid';
}
$expID = $_POST['expenseID'];
echo $expID;

?>