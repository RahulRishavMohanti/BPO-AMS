<?php
session_start();

if($_POST['submit']) {
	//include_once('/LoginApp/connection.php');
  include_once('connection.php');

	$empname = strip_tags($_POST['username']);
	$password = strip_tags($_POST['password']);
	$password = md5($password);

	$sql = "SELECT * FROM Employees where UserName = '$empname' LIMIT 1";
	$query = mysqli_query($db, $sql);
	if($query) {
		$row = mysqli_fetch_row($query);
		$dbUserName = $row[0];
		$dbPassword = $row[1];
		$location = $row[2];
	}
	if($empname == $dbUserName && $password == $dbPassword) {
		$_SESSION['empname'] = $empname;
		$_SESSION['loc'] = $location;
		header('Location: /LoginApp/Emp/dash.php');

	}
	else {
		$errorm = "Incorrect Credentials";
	}

}
else if($_SESSION['success'])
{
	$message="Logged Out";
	unset($_SESSION['success']);

}

?>


<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<title>Asset Management System</title>
	<link rel="stylesheet" href="/LoginApp/public/css/bootstrap.css" />
	<link rel="stylesheet" href="/LoginApp/public/css/style2.css" />
<style>
body{
	background-image: url("/LoginApp/public/bg2.jpg");
	background-size: cover;
}
.container{
    max-width: 90%;
    position: absolute;
     left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  box-shadow: 0px 0px 0px ;
    margin-top: 5%;
    margin-bottom: : 5%;

  }
  .page-header{
  	margin: 0;
  }

  .cardy{
    max-width:500px;
    right: 0;
    left: auto;
    background: white;
    padding: 50px;
    border-radius: 10px;
    margin:auto;
    color: black;
  }
  .headery{
    padding: 10px;
    top:0;
    position: fixed;
    width:100%;
    height: 60px;
    background: white;
    z-index: 10;
    box-shadow: 0px 2px 10px grey;

  }
  .footer{
    padding: 10px;
    position: fixed; /* Set the navbar to fixed position */
    bottom: 0; /* Position the navbar at the bottom of the page */
    width: 100%; 
    background: white;
    z-index: 10;
  }

</style>
</head>
<body>
	<div class="headery">
		<nav>
	        <ul class="nav nav-pills pull-right">
	        	<li role="presentation"><a href="/LoginApp/Emp/empLogin.php">Login</a></li>
			</ul>
	    </nav>
	    <a href="/LoginApp/index.php"><img height="50" src="/LoginApp/public/logo.jpg"></a>
    </div>
	<div class="container">
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
		<div class="cardy">
			<h2 align="center" class="page-header">Employee Login</h2>
			<form method="post" action="/LoginApp/Emp/empLogin.php">
		  		<div class="form-group">
		  	    	<label>Username</label>
					<input type="text" class="form-control" name = "username" placeholder="Enter username">
				</div>
				<div class="form-group">
			    	<label>Password</label>
					<input type="password" class="form-control" name="password" placeholder="Enter password here">
				</div>
				<button style="width: 100%;" name="submit" type="submit" class="btn btn-success" value="submit">Submit</button>
			</form>
		</div>
	</div>
    <div class="footer">
    	<p>&copy; BPO Convergence Ltd.</p>
    </div>

</body>
</html>
