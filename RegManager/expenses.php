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
  <title>Asset Management System</title>
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

#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: absolute; /* Stay in place */
  z-index: 5; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
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
  <div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
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
    echo "<td  id=\"$row[1]\" class=active_td>" . $row[4] . "<a></td>";
  }
  $formID = $row[1]."form";
  echo "<td  style=display:none><form class=form id=\"$formID\" action=recieptUpload.php method=POST enctype=multipart/form-data>
  Remark:<input type=text name=remark>
  <input type=text style=display:none name=expenseID value=\"".$row[1]."\">

  <input type=submit id=upload-button value=\"Approve Expense\"></form></td>";

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
  var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = "/LoginApp/Emp/uploads/"+str;
console.log(img);
var modalImg = document.getElementById("img01");
  modal.style.display = "block";
  modalImg.src = img;

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
}
</script>


</html>