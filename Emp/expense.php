<?php
session_start();
  include_once('connection.php');
if (isset($_SESSION['empname'])){
  $username = $_SESSION['empname'];
}
else {
  header('Location: empLogin.php');
  die();
}
?>

<!DOCTYPE html>
<html>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <head>
  <title>Asset Management System</title>
    <link rel="stylesheet" href="/LoginApp/public/css/bootstrap.css" />
    <link rel="stylesheet" href="/LoginApp/public/css/style2.css" />
    <style type="text/css">
      td,th{
        text-align: center;
      }
      .cardy{
        margin-bottom: 10%;
      }
      #qrcode {
        width:50%;
        height:50%;
        margin-top:15px;
      }
      input, label {vertical-align:middle}
      .qrcode-text {
        padding-right:1.7em; 
        margin-right:0
      }
      .qrcode-text-btn {
        display:inline-block;
        background-image:url(qr.png);
        height:1em; 
        width:1.7em; 
        margin-left:-1.7em; 
        cursor:pointer
      }
      .qrcode-text-btn > input[type=file] {
        position:absolute; 
        overflow:hidden; 
        width:1px; 
        height:1px; 
        opacity:0
      }
    </style>
  </head>

  <body >
    <div class="headery">
      <nav>
            <ul class="nav nav-pills pull-right">
              <li role="presentation"><a href="/LoginApp/Emp/logout.php">Logout</a></li>
            </ul>
      </nav>
      <img style="float: left;" height="50" src="/LoginApp/public/logo.jpg">
    </div>
    <div class="container">
      <h2 class="page-header"><a class="text-muted" href="/LoginApp/Emp/dash.php">new</a> <a class="text-muted" href="/LoginApp/Emp/update.php">update</a> <a class="text-muted" href="/LoginApp/Emp/delete.php">delete</a> <a class="text-muted" href="/LoginApp/Emp/ticket.php">ticket</a> expense</h2>
      <div class="cardy">
          
      <form name="myform" method="post" id="f1" action="/LoginApp/Emp/expense.php" enctype="multipart/form-data">
	      <div class="form-group">
	              <label>Expense</label>
	          <input type="text" class="form-control" name="expense" placeholder="Enter Expense">
	        </div>
	        <div class="form-group">
	            <label>Amount</label>
	           <input type="number" class="form-control" name="amount" step="0.01" placeholder="Enter Amount">
	        </div>
	        <div class="form-group">
	            <label>Reciept</label>
	          <input type="file" class="form-control" id="uploadImage" accept="image/*" name="image">
	        </div>
	        <button name="submit" type="submit" class="btn btn-default" value="submit">Submit</button>
    	</form>
    <div class="table-wrapper">

<?php 
$id = $_SESSION['empname'];
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'uploads/'; // upload directory
$expenseID = uniqid();

if(($_POST['expense']) && ($_POST['amount']))
{

	$img = $_FILES['image']['name'];
	$tmp = $_FILES['image']['tmp_name'];
	 
	// get uploaded file's extension
	$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

	//can upload same image using rand function
	$final_image = $expenseID;
	 
	// check's valid format

	if(in_array($ext, $valid_extensions)) 
	{

	$path = $path.strtolower($expenseID);

	move_uploaded_file($tmp,$path);
	}
  	$expense = strip_tags($_POST['expense']);
	$amount =  strip_tags($_POST['amount']);
	$status = "Pending";
	$loc = $_SESSION['loc'];
	$re = "blank";
	$sql="INSERT INTO Expenses(id,expenseID,expense,amt,status,location,remark) VALUES ('$id','$expenseID','$expense','$amount','$status','$loc','$re')";

	$result = mysqli_query($db, $sql);
}
	

  $sql="SELECT * FROM Expenses WHERE id='$id'";

  $result = mysqli_query($db, $sql);

  echo "<table class='table table-hover'>

  <thead class='thead-dark'>

  <tr>

  <th>Employee</th>

  <th>Location</th>

  <th>Expense</th>

  <th>Amount</th>

  <th>Status</th>
  </tr>
  </thead>";


  while($row = mysqli_fetch_array($result))

    {

    echo "<tr>";

    echo "<td>" . $row[0] . "</td>";
    
    echo "<td>" . $row[5] . "</td>";
    

    echo "<td>" . $row[2] . "</td>";

    echo "<td>" . $row[3] . "</td>";

    echo "<td>" . $row[4] . "</td>";
    echo "</tr>";

    }

  echo "</table>";

   
  mysqli_close($con);

?>
</div>

</div>
     </div>
    <footer class="footer">
      <p>&copy; BPO Convergence Ltd.</p>
    </footer>
</body>
</html>