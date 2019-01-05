<?php
	session_start();
	//session_destroy();
	unset($_SESSION['username']);
	$_SESSION['success']= "Successfully Loggged Out!";
	header('Location: index1.php');
?>