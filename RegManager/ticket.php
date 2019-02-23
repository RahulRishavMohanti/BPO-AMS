<?php
session_start();
  include_once('connection.php');
if (isset($_SESSION['manager'])){
  $manager = $_SESSION['manager'];
  $loc = $_SESSION['managerLocation'];
}
else {
  header('Location: index1.php');
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
table{
      table-layout: fixed;

}
td,th{
  font-size: auto;
  text-align: center;
  word-wrap: break-word;

}
.maintenance_td{
  background-color: orange;
}
.active_td{
  background-color: green;

}
.inactive_td{
  background-color: red;

}
.SearchBar{
    width:100%;
    border:none;
}
.SearchBar:active{
    border: 0;
  outline: 0;
  background: transparent;
  border-bottom: 1px solid black;
}
</style>
</head>

<body>
  <div class="headery">
    <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="logout.php">Logout</a></li>
          </ul>
    </nav>
    <img style="float: left;" height="50" src="/LoginApp/public/logo.jpg">
    </div>
<div class="container">
<h2 class="page-header"><a class="text-muted" href="dash.php">Assets</a> Ticket <a class="text-muted" href="expenses.php"> Expenses</a> </h2>
<div class="cardy">
<input class="SearchBar" type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in an Item Name">
<div class="table-wrapper">

<?php 

$sql="SELECT Ticket.id, Ticket.Status, Ticket.Ticket
FROM Ticket
INNER JOIN Items
ON Ticket.id=Items.id WHERE Items.location='$loc'";

$result = mysqli_query($db, $sql);

echo "<table id='itemTable' class='table table-hover'>

<thead class='thead-dark'>

<tr>

<th>Item ID</th>

<th>Ticket</th>

<th>Status</th>

</tr>
</thead>";


while($row = mysqli_fetch_array($result))

  {

  echo "<tr>";

  echo "<td>" . $row[0] . "</td>";

  echo "<td>" . $row[2] . "</td>";

  if(!(strcmp($row[1],"Unresolved")))
  {
    echo "<td class=maintenance_td>" . $row[1] ."</td>";
  }
    else
  {
    echo "<td class=active_td>" . $row[1] . "</td>";
  }
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
</div>
</body>
<script>
    function myFunction() {
  // Declare variables
  var input, filter, ul, li, a, i;
  input = document.getElementById("mySearch");
  filter = input.value.toUpperCase();
  ul = document.getElementById("itemTable");
  li = ul.getElementsByTagName("tr");

  // Loop through all list items, and hide those who don't match the search query
  for (i = 1; i < li.length; i++) {
    a = li[i].getElementsByTagName("td")[1];
    if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}
</script>
</html>