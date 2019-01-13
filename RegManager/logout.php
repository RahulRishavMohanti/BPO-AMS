<?php
	session_start();
	//session_destroy();
	unset($_SESSION['manager']);
	unset($_SESSION['managerLocation']);

	$_SESSION['success']= "Successfully Loggged Out!";
	header('Location: index1.php');
?>