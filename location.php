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
<h2 class="page-header"><a class="text-muted" href="/LoginApp/dash.php">Assets </a><a class="text-muted" href="/LoginApp/staff.php">Staff</a> Location</h2>
<div class="cardy">


</div>
</div>


      <footer class="footer">
        <p>&copy; BPO Convergence Ltd.</p>
      </footer>
</div>
</body>
</html>