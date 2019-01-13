<?php
	session_start();
	//session_destroy();
	unset($_SESSION['empname']);
	unset($_SESSION['loc']);
	$_SESSION['success']= "Successfully Loggged Out!";
	header('Location: /LoginApp/Emp/empLogin.php');
?>