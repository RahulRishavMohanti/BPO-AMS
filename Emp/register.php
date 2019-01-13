<?php 
	session_start();
	  		include_once('connection.php');

	$query2 = "SELECT * FROM locationList";
	$result1 = mysqli_query($db,$query2);

	if($_POST['submit']){
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
		$password = md5($password);
		$loc = strip_tags($_POST['Location']);
		$query = "INSERT INTO Employees(UserName,Password,Location) VALUES('$username', '$password','$loc')";
		$result = mysqli_query($db,$query);
		if($result) {
			echo "Succesfully registered";
			header('Location: empLogin.php');
		}
		else {
			echo "Failed to register";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
		<link rel="stylesheet" href="/LoginApp/public/css/bootstrap.css" />
	<link rel="stylesheet" href="/LoginApp/public/css/style.css" />
</head>
<body>
	<div class="container">
		<div class="header clearfix">
<h1>Register</h1>
<form method="post" action="register.php">
	<div class="form-group">
            <label for="UserName">UserName</label>
	<input type="text" name = "username" placeholder="Enter username">
</div>
	<div class="form-group">
            <label for="Password">Password</label>
	<input type="password" name="password" placeholder="Enter password here">
		</div>
	<div class="form-group">
            <label for="Location">Location</label>
            <select class="form-control" name="Location">
              <?php
              while($row = mysqli_fetch_array($result1))
              {
                echo "<option>".$row[0]."</option>";
              }
            ?>
            </select>
          </div>
	<input type="submit" name="submit" value="Register">
</form>
</div>
</div>
<a href = "empLogin.php" >Login</a>

</body>
</html>