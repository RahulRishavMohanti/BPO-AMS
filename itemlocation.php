<?php
session_start();
  include_once('connection.php');
if (isset($_SESSION['username'])){
  $username = $_SESSION['username'];

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
  <link rel="stylesheet" href="public/css/bootstrap.css" />
  <link rel="stylesheet" href="public/css/style2.css" />
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
.container2{
  position: relative;
}
.img1{
width: 20px;}
.img1:hover{
width: 30px;}
.imgContainer{
width:100%;
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
    width:98%;
    float: left;
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
            <li role="presentation"><a href="/LoginApp/logout.php">Logout</a></li>
          </ul>
    </nav>
    <img style="float: left;" height="50" src="/LoginApp/public/logo.jpg">
    </div>
<div class="container">
<h2 class="page-header"><a class="text-muted" href="/LoginApp/dash.php">Assets </a><a class="text-muted" href="/LoginApp/ticket.php"> Ticket</a> <a class="text-muted" href="/LoginApp/expenses.php">Expenses</a> Item&location</h2>
<h2 class="page-header">Items</h2>

<div class="cardy">
<div class="imgContainer">
<input class="SearchBar" type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in an Item Name">
<img onClick="addItem()" class="img2" height="20px" src="public/add_green.png">
</div>
<div class="table-wrapper">

<?php 

$sql="SELECT * FROM itemList";

$result = mysqli_query($db, $sql);

echo "<table id='itemTable' class='table table-hover'>

<thead class='thead-dark'>

<tr>

<th>Item</th>
<th>Status</th>
</tr>
</thead>";


while($row = mysqli_fetch_array($result))

  {

  echo "<tr id=\"$row[0]\">";

  echo "<td>" . $row[0] . "</td>";

  echo "<td><a onClick=deleteItem(\"$row[0]\")><img class='img1' src='public/minus_red.png'> </td>"; 

  echo "</tr>";
}
echo "</table>";

 

mysqli_close($con);

?>
</div>

</div>


<h2 class="page-header">Locations</h2>
<div class="cardy">
<div class="imgContainer">
<input class="SearchBar" type="text" id="mySearch2" onkeyup="myFunction2()" placeholder="Search.." title="Type in an Location Name">
<img onClick="addLocation()" class="img2" height="20px" src="public/add_green.png">
</div>
<div class="table-wrapper">

<?php 

$sql="SELECT * FROM locationList";

$result = mysqli_query($db, $sql);

echo "<table id='locationTable' class='table table-hover'>

<thead class='thead-dark'>

<tr>

<th>Item</th>
<th>Status</th>
</tr>
</thead>";


while($row = mysqli_fetch_array($result))

  {
  echo "<tr id=\"$row[0]\">";

  echo "<td>" . $row[0] . "</td>";

  echo "<td><a onClick=deleteLocation(\"$row[0]\")><img class='img1' src='public/minus_red.png'> </td>"; 

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
    console.log(i);
    if(li[i].getElementsByTagName("td").length>0)
    {
        a = li[i].getElementsByTagName("td")[0];
      if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
        li[i].style.display = "";
      } else {
        li[i].style.display = "none";
      }
    }
  }
}
function myFunction2() {
  // Declare variables
  var input, filter, ul, li, a, i;
  input = document.getElementById("mySearch2");
  filter = input.value.toUpperCase();
  ul = document.getElementById("locationTable");
  li = ul.getElementsByTagName("tr");

  // Loop through all list items, and hide those who don't match the search query
  for (i = 1; i < li.length; i++) {
    console.log(i);
    if(li[i].getElementsByTagName("td").length>0)
    {
        a = li[i].getElementsByTagName("td")[0];
      if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
        li[i].style.display = "";
      } else {
        li[i].style.display = "none";
      }
    }
  }
}
function deleteItem(str) {
  console.log(str);
  //document.getElementById(str).innerHTML="assa";
  var xhttp;
  if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
            console.log("XMLHttpRequest Done");
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(str).style.display = "none";            }
        };
        xmlhttp.open("GET","itemDelete.php?q="+str,true);
        xmlhttp.send();
}

function addItem(){
  var itemNew = prompt("Enter New Item");
  if(itemNew)
  {
    var xhttp;
    if (window.XMLHttpRequest) {
              // code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp = new XMLHttpRequest();
              console.log("XMLHttpRequest Done");
          } else {
              // code for IE6, IE5
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    if(this.responseText=="success")
                    {
                        var node = document.createElement("TR");
                        node.setAttribute("id",itemNew);
                        var tdnode = document.createElement("TD");
                        var tdnode2 = document.createElement("TD");
                        var textNode = document.createTextNode(itemNew);
                        var aNode = document.createElement("A");
                        aNode.setAttribute("onClick","deleteItem(\""+itemNew+"\")");

                        var imgNode = document.createElement("IMG");
                        imgNode.setAttribute("src","public/minus_red.png");
                        imgNode.setAttribute("class","img1");
                        tdnode.appendChild(textNode);
                        aNode.appendChild(imgNode);
                        tdnode2.appendChild(aNode);
                        node.appendChild(tdnode);
                        node.appendChild(tdnode2);
                      if(document.getElementById("itemTable").childNodes[2]!=undefined)
                      {document.getElementById("itemTable").childNodes[2].appendChild(node);}
                    else
                    {
                      document.getElementById("itemTable").childNodes[1].appendChild(node);
                    }
                    
                    }
                    else
                      window.alert("Item Already Exists");
                    }
                    
          };
          xmlhttp.open("GET","addItem.php?q="+itemNew,true);
          xmlhttp.send();
  }}
  function deleteLocation(str) {
  console.log(str);
  //document.getElementById(str).innerHTML="assa";
  var xhttp;
  if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(str).style.display = "none";            }
        };
        xmlhttp.open("GET","deleteLocation.php?q="+str,true);
        xmlhttp.send();
}

function addLocation(){
  var itemNew = prompt("Enter New Location");
  if(itemNew)
  {
    var xhttp;
    if (window.XMLHttpRequest) {
              // code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp = new XMLHttpRequest();
          } else {
              // code for IE6, IE5
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                    if(this.responseText=="success")
                    {
                          var node = document.createElement("TR");
                          node.setAttribute("id",itemNew);
                          var tdnode = document.createElement("TD");
                          var tdnode2 = document.createElement("TD");
                          var textNode = document.createTextNode(itemNew);
                          var aNode = document.createElement("A");
                          aNode.setAttribute("onClick","deleteItem(\""+itemNew+"\")");

                          var imgNode = document.createElement("IMG");
                          imgNode.setAttribute("src","public/minus_red.png");
                          imgNode.setAttribute("class","img1");
                          tdnode.appendChild(textNode);
                          aNode.appendChild(imgNode);
                          tdnode2.appendChild(aNode);
                          node.appendChild(tdnode);
                          node.appendChild(tdnode2);
                        if(document.getElementById("locationTable").childNodes[2]!=undefined)
                        {document.getElementById("locationTable").childNodes[2].appendChild(node);}
                      else
                      {
                        document.getElementById("locationTable").childNodes[1].appendChild(node);
                      }
                }
                else
                {
                  window.alert("Location Already Exists");
                }
                }
          };
          xmlhttp.open("GET","addLocation.php?q="+itemNew,true);
          xmlhttp.send();
  }}
</script>
</html>