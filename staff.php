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
td,th{
	text-align: center;
}
  #myProgress {
  margin-top: 1%;
  width: 100%;
  background-color: #ddd;
}

#myBar {
	margin-top: 1%;
  width: 0%;
  height: 30px;
  background-color: #4CAF50;
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
<h2  class="page-header"><a class="text-muted" href="/LoginApp/dash.php">Assets</a> Staff <a class="text-muted" href="/LoginApp/location.php">Location</a></h2>
<div class="cardy">
			<h2 align="center" class="page-header">Login</h2>
			<form method="post" action="/LoginApp/staff.php">
		  		<div class="form-group">
		  	    	<label>Employee Name</label>
					<input type="text" class="form-control" name = "username" placeholder="Enter username">
				</div>
				<div class="form-group">
		  	    	<label>Employee Name</label>
					<input type="text" class="form-control" name = "username" placeholder="Enter username">
				</div>
				<div class="form-group">
		  	    	<label>Age</label>
					<input type="text" class="form-control" name = "username" placeholder="Enter username">
				</div>
				<div class="form-group">
		  	    	<label>Education</label>
					<input type="text" class="form-control" name = "username" placeholder="Enter username">
				</div>
				<div class="form-group">
		  	    	<label>Department</label>
					<input type="text" class="form-control" name = "username" placeholder="Enter username">
				</div>
				<div class="form-group">
		  	    	<label>Role</label>
					<input type="text" class="form-control" name = "username" placeholder="Enter username">
				</div>
				<div class="form-group">
		  	    	<label>Distance from Home</label>
					<input type="text" class="form-control" name = "username" placeholder="Enter username">
				</div>
			</form>
			<button name="submit" type="" class="btn btn-default" value="" onclick="move()">Submit</button>
		<div id="myProgress">
  <div id="myBar"></div>
</div>
<div id="prog">0</div>
	
		</div>
	</div>
</div>
      <div class="footer">
        <p>&copy; BPO Convergence Ltd.</p>
      </div>

</body>
<script>
function move() {
  var elem = document.getElementById("myBar");   
  var prog = document.getElementById("prog");   
  var width = 1;
  var x = Math.floor((Math.random() * 100) + 1);
  var id = setInterval(frame, 10);
  function frame() {
    if (width >= x) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
      prog.innerHTML ="Performance Grade:" + width/10;
    }
  }
}
</script>
</html>