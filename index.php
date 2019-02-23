<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<title>Asset Management System</title>
	<link rel="stylesheet" href="public/css/bootstrap.css" />
	<link rel="stylesheet" href="public/css/style2.css" />
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
  margin-top: 5%;
    margin-bottom: : 5%;

  box-shadow: 0px 0px 0px ;
  }

  .cardy{
    max-width:500px;
    right: 0;
    left: auto;
    background: white;
    padding:2px 10px 30px 10px;
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
	    </nav>
	    <img height="50" src="/LoginApp/public/logo.jpg">
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
			<h2 align="center" class="page-header">Select Login</h2>
			<a style="width:33%;" class="btn btn-primary btn-large" href ="Emp/empLogin.php"> Employee Login</a>
			<a style="width:30%;" class="btn btn-primary btn-large" href ="index1.php"> Central Login</a>
      <a style="width:33%;" class="btn btn-primary btn-large" href ="RegManager/index1.php"> Regional Login</a>
		</div>
	</div>
    <div class="footer">
    	<p>&copy; BPO Convergence Ltd.</p>
    </div>

</body>
</html>
