<?php
session_start();
  include_once('connection.php');
if (isset($_SESSION['empname'])){
  $username = $_SESSION['empname'];
  $query = "SELECT * FROM itemList";
  $query2 = "SELECT * FROM locationList";
  $result1 = mysqli_query($db,$query);
  $result2 = mysqli_query($db,$query2);
}
else {
  header('Location: empLogin.php');
  die();
}

if($_POST['submit']) {
  if(count(array_filter($_POST))!=count($_POST)){
    $errorm="One of the fields is empty";
  }
  else
  {
    $ItemType = strip_tags($_POST['ItemType']);
    $ItemID = uniqid();
    $Location = strip_tags($_POST['Location']);
    $Date = strip_tags($_POST['Date']);
    $status = "Active";
      $query = "INSERT INTO Items(type,id,location,dat,STATUS) VALUES('$ItemType', '$ItemID','$Location','$Date','$status')";
      $result = mysqli_query($db,$query);
      if($result) {
        echo "Succesfully added";
      }
      else {
        $errorm = "Failed to add! Try with a different ID!";
      }
  }
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
        background: #fff;
      }
      #qrcode {
        width:50%;
        height:50%;
        margin-top:15px;
        display:none;
      }
      .imgWrapper{
    height: 200px;
    width: 200px;
  }

    </style>
  </head>

  <body onload="makeCode('<?php echo htmlspecialchars($ItemID) ?>')">
    <div class="headery">
      <nav>
            <ul class="nav nav-pills pull-right">
              <li role="presentation"><a href="/LoginApp/Emp/logout.php">Logout</a></li>
            </ul>
      </nav>
      <img style="float: left;" height="50" src="/LoginApp/public/logo.jpg">
    </div>
    <div class="container">

      <h2 class="page-header">new <a class="text-muted" href="/LoginApp/Emp/update.php">update</a>  <a class="text-muted" href="/LoginApp/Emp/delete.php">delete</a> <a class="text-muted" href="/LoginApp/Emp/ticket.php">ticket</a> <a class="text-muted" href="/LoginApp/Emp/expense.php"> expense </a></h2>
      <div class="row">
          <div class="col-lg-12">
            <?php if($message)
            {?>
            <div class='alert alert-success'><?php echo "$message" ?></div><?php }
            else if($errorm)
              {?>
            <div class='alert alert-danger'><?php echo "$errorm" ?></div><?php } ?>
          </div>
      </div>
      <div id="cardy" class="cardy">

        <form method="post" action="/LoginApp/Emp/dash.php">
          <div class="form-group">
            <label for="ItemType">Item Type</label>
            <select class="form-control" name="ItemType">
              <?php
              while($row = mysqli_fetch_array($result1))
              {
                echo "<option>".$row[0]."</option>";
              }
            ?>
            </select>
          </div>
          <div class="form-group">
            <label for="Location">Location</label>
            <select class="form-control" name="Location">
              <?php
              while($row = mysqli_fetch_array($result2))
              {
                echo "<option>".$row[0]."</option>";
              }
            ?>
            </select>
          </div>
          <div class="form-group">
            <label for="Date">Date</label>
            <input id="DatePicker" type="date" class="form-control" name="Date" placeholder="Enter Date of Entry">
          </div>
          <input class="btn btn-default" type="submit" name="submit" value="Register">
        </form>
        <div id="qrcode" ></div>
        <br>
      <canvas style="display:none;padding-right:100px;padding-top:50px;" id="barcode"></canvas>
      <img id="canvasImg">
      </div>
    </div>
    <footer class="footer">
      <p>&copy; BPO Convergence Ltd.</p>
    </footer>
  </body>
  <script src="/LoginApp/public/js/qrcode.js"></script>
  <script src="/LoginApp/public/js/jquery-3.3.1.js"></script>
<script src="/LoginApp/Emp/JsBarcode.code128.min.js"></script>

  <script type="text/javascript">
    var qrcode = new QRCode("qrcode");
    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0,10);
    });

  function makeCode (elText) {   
    document.getElementById('DatePicker').value = new Date().toDateInputValue();
 
    //var elText = document.getElementById("text");
    console.log(elText);
    if (!elText) {
          console.log("no");

      return;
    }
    else{
      //qrcode.makeCode(elText);
      JsBarcode("#barcode", elText);
      /*var svgData = $("#barcode")[0].outerHTML;
    var svgBlob = new Blob([svgData], {type:"image/svg+xml;charset=utf-8"});
    var svgUrl = URL.createObjectURL(svgBlob);
    var downloadLink = document.createElement("a");
    downloadLink.href = svgUrl;
    downloadLink.download = "x.svg";
  */  
    var canvas = document.getElementById("barcode"),
      context = canvas.getContext("2d");
        
  /*  var image = new Image;
    image.src = downloadLink.href;
    image.onload = function() {
      context.drawImage(image, 0, 0);
    */
        
    var dataURL = canvas.toDataURL("jpg");
    document.getElementById("canvasImg").src=dataURL;

    //document.body.appendChild(downloadLink);
    //downloadLink.click();
    //document.body.removeChild(downloadLink);


    }
    makeCode();

  }

  </script>
</html>