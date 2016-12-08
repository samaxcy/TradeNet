<!DOCTYPE html>
<html>

<head>
  <title>Oops!</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
</head>

<?php
    require 'header.php';
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <ul class="nav navbar-nav navbar-left">
            <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </div>
</nav>


<body>
	<div class="col-lg-3 col-md-3"></div>
	<div class="col-lg-6 col-md-6">
		<h1>Login Failed</h1>
		<br/>
		<br/>
		<h3>Click <a href="index.php">here</a> to return to home or <a href="login.php">here</a> to try again!</h3>
	</div>
	<div class="col-lg-3 col-md-3"></div>
</body>

<?php
	require '../php_components/footer.php';
?>

</html>
