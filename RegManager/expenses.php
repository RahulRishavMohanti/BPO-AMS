<?php
session_start();
  include_once('connection.php');
if (isset($_SESSION['manager'])){
  $username = $_SESSION['manager'];

}
else {
  header('Location: index.php');
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
table{
      table-layout: fixed;

}
a{
  color: black;
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
<h2 class="page-header"><a class="text-muted" href="dash.php">Assets </a><a class="text-muted" href="ticket.php"> Ticket</a> Expenses</h2>
<div class="cardy">
<input class="SearchBar" type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in an Item Name">
<div class="table-wrapper">

<?php 
$loc = $_SESSION['managerLocation'];
$sql="SELECT * FROM Expenses WHERE location='$loc' ORDER BY status DESC";

$result = mysqli_query($db, $sql);

echo "<table id='itemTable' class='table table-hover'>

<thead class='thead-dark'>

<tr>

<th>User</th>

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

  if(!(strcmp($row[4],"Pending")))
  {
    echo "<td id=\"$row[1]\" class=maintenance_td><a onClick=approveExpense(\"$row[1]\")>" . $row[4] ."<a></td>";
  }
  else
  {
    echo "<td  id=\"$row[1]\" class=active_td><a onClick=approveExpense(\"$row[1]\")>" . $row[4] . "<a></td>";
  }
  $formID = $row[1]."form";
  echo "<td  style=display:none><form class=form id=\"$formID\" action=recieptUpload.php method=POST enctype=multipart/form-data>
  Remark:<input type=text name=remark>
  <input type=file id=uploadImage accept=image/* name=image>
  <input type=text style=display:none name=expenseID value=\"".$row[1]."\">

  <input type=submit id=upload-button value=\"Upload Reciept\"></form></td>";

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

<script type="text/javascript" src="/LoginApp/public/js/jquery-3.3.1.js"></script>
<script>
$(document).ready(function (e) {
  console.log("jquery up");
 $(".form").on('submit',(function(e) {
  console.log("jquery up");
  e.preventDefault();
  $.ajax({
         url: "recieptUpload.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
    //$("#preview").fadeOut();
    console.log("Sending");
   },
   success: function(data)
      {
    if(data=='invalid')
    {
     // invalid file format.
     console.log("invalid file");
    }
    else
    {
     // view uploaded file.
     console.log(data);
     $("#"+data).next().css({"display":"none"});
     $("#"+data).css({"display":"block"});
     $("#"+data).addClass("active_td");
     $("#"+data).text("Approved");
         }
      },
     error: function(e) 
      {
      console.log(e);
      }          
    });
 }));
});
</script>
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
    a = li[i].getElementsByTagName("td")[0];
    if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}
function approveExpense(str) {
  console.log(str);
  if (typeof jQuery == 'undefined') {

  console.log("noJ");

}
  //var remark=window.prompt("Enter Remarks");
  //str1 = str+"."+remark;
  document.getElementById(str).nextSibling.style.display = "block";
  document.getElementById(str).style.display = "none";
}
</script>


</html>