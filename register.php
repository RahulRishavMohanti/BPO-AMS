<?php 
	session_start();
	if($_POST['submit']){
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
		$password = md5($password);
		$db = mysqli_connect("localhost", "root", "root", "loginapp",8889) or die ("Failed to connect");
		$query = "INSERT INTO Employees(username,password) VALUES('$username', '$password')";
		$result = mysqli_query($db,$query);
		if($result) {
			echo "Succesfully registered";
			header('Location: index.php');
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
		<link rel="stylesheet" href="/css/bootstrap.css" />
	<link rel="stylesheet" href="/css/style.css" />
</head>
<body>
	<div class="container">
		<div class="header clearfix">
<h1>Register</h1>
<form method="post" action="register.php">
	<input type="text" name = "username" placeholder="Enter username">
	<input type="password" name="password" placeholder="Enter password here">
	<input type="submit" name="submit" value="Register">
</form>
</div>
</div>
<a href = "index.php" >Login</a>

</body>
</html>