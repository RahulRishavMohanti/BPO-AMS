<?php
session_start();
  include_once('connection.php');
if (isset($_SESSION['username'])){
  $username = $_SESSION['username'];
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
    <title>PHP-SQL Login</title>
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
      <h2 class="page-header"><a class="text-muted" href="/LoginApp/Emp/dash.php">new</a> <a class="text-muted" href="/LoginApp/Emp/update.php">update</a><a class="text-muted" href="/LoginApp/Emp/delete.php"> delete</a><a class="text-muted" href="/LoginApp/Emp/ticket.php"> ticket </a> expense</h2>
      <div class="cardy">
          
      <form name="myform" method="post" id="f1" action="/LoginApp/Emp/expense.php">
      <div class="form-group">
              <label>Expense</label>
          <input type="text" class="form-control" name="expense" placeholder="Enter Expense">
        </div>
        <div class="form-group">
            <label>Amount</label>
           <input type="number" class="form-control" name="amount" step="0.01" placeholder="Enter Amount">
        </div>
        <button name="submit" type="submit" class="btn btn-default" value="submit">Submit</button>
    </form>
    <div class="table-wrapper">

<?php 
$id = $_SESSION['username'];
if(($_POST['expense']) && ($_POST['amount']))
{

  $expense = strip_tags($_POST['expense']);
  $amount =  strip_tags($_POST['amount']);
  $status = "Pending";
  $expenseID = uniqid();
  $sql="INSERT INTO Expenses(id,expenseID,expense,amt,status) VALUES ('$id','$expenseID','$expense','$amount','$status')";

  $result = mysqli_query($db, $sql);
 }
  $sql="SELECT * FROM Expenses WHERE id='$id'";

  $result = mysqli_query($db, $sql);

  echo "<table class='table table-hover'>

  <thead class='thead-dark'>

  <tr>

  <th>Employee</th>

  <th>Expense</th>

  <th>Amount</th>

  <th>Status</th>
  </tr>
  </thead>";


  while($row = mysqli_fetch_array($result))

    {

    echo "<tr>";

    echo "<td>" . $row[0] . "</td>";

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