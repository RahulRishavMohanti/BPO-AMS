<?php
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'uploads/'; // upload directory

if(!empty($_POST['remark']) || !empty($_POST['expenseID']) || !empty($_FILES['image']))
{
$img = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];
 
// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

//can upload same image using rand function
$final_image = $_POST['expenseID'];
 
// check's valid format

if(in_array($ext, $valid_extensions)) 
{

$path = $path.strtolower($final_image);

if(move_uploaded_file($tmp,$path)) 
{
$appr = "Approved";
$rem = $_POST['remark'];
$expID = $_POST['expenseID'];
$sql="UPDATE Expenses SET status='$appr',remark='$rem' WHERE expenseID='$expID'";
 
//include database configuration file
include_once 'connection.php';
$result = mysqli_query($db,$sql);

}

} 
else 
{
echo 'invalid';
}

}
$expID = $_POST['expenseID'];
echo $expID;

?>