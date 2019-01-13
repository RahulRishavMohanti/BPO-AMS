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
    <title>PHP-SQL Login</title>
    <link rel="stylesheet" href="/LoginApp/public/css/bootstrap.css" />
    <link rel="stylesheet" href="/LoginApp/public/css/style2.css" />
    <style type="text/css">
      td,th{
        text-align: center;
      }
      a{
        color: black;
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
      <h2 class="page-header"><a class="text-muted" href="/LoginApp/Emp/dash.php">new</a> <a class="text-muted" href="/LoginApp/Emp/update.php">update</a> <a class="text-muted" href="/LoginApp/Emp/delete.php">delete</a> ticket <a class="text-muted" href="/LoginApp/Emp/expense.php"> expense </a></h2>
      <div class="cardy">
          
      <form name="myform" method="post" id="f1" action="/LoginApp/Emp/ticket.php">
        <div class="controls">
            <fieldset class="input-group">
                <input type="file" accept="image/*" capture="camera"/>
            </fieldset>
        </div>
        <div id="result_strip">
            <ul  class="thumbnails"></ul>
        </div>
      <input style="visibility: hidden;" id="x" name="id"><br>
      <div class="form-group">
            <label>Ticket</label>
           <input type="text" class="form-control" name="ticket" placeholder="Enter Ticket">
      </div>
      <a class="btn btn-default" href="javascript: openQRCamera()">
      Raise Ticket
      </a>      
    </form>
    <div class="table-wrapper">

<?php 
  $empID = $_SESSION['empname'];
if(($_POST['id']) && ($_POST['ticket']))
{
  $idItem = strip_tags($_POST['id']);
  $ticket = strip_tags($_POST['ticket']);
  $stat = "Unresolved";
  $ticketid = uniqid();

  $sql="INSERT INTO Ticket(id,empid,ticketid,ticket,Status) VALUES ('$idItem','$empID','$ticketid','$ticket','$stat')";

  $result = mysqli_query($db, $sql);
}
  $sql="SELECT * FROM Ticket WHERE empid='$empID'";

  $result = mysqli_query($db, $sql);

  echo "<table class='table table-hover'>

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

    echo "<td>" . $row[3] . "</td>";

    echo "<td id=\"$row[2]\"><a onClick=resolveTicket(\"$row[2]\")>" . $row[4] . "</td>";

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
  <script src="/LoginApp/public/js/qrcode.js"></script>
  <script src="/LoginApp/public/js/jquery-3.3.1.js"></script>
<script src="qr_packed.js"></script>
<script src="quagga.js" type="text/javascript"></script>
<script src="file_input.js" type="text/javascript"></script>
  <script type="text/javascript">
  function resolveTicket(str)
  {
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
                document.getElementById(str).innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","approve.php?q="+str,true);
        xmlhttp.send();
  }
  function openQRCamera() {
if(document.myform.onsubmit && !document.myform.onsubmit())
          {
              return;
          }
          document.myform.submit();
}

  </script>
</html>