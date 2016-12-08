<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
</head>
<body>

<?php
    require 'header.php';
?>

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<ul class="nav navbar-nav navbar-left">
			<li><a href="../index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="twitter.php"><span class="glyphicon glyphicon-stats"></span> Twitter</a></li>
            <li><a href="nyt.php"><span class="glyphicon glyphicon-list"></span> View New York Times Headlines </a></li>
		</ul>
	</div>
</nav>

<div class="col-lg-3 col-md-3"></div>
<div class="col-lg-6 col-md-6">
    <legend><h1>Login</h1></legend> <br /><br />
    <form name="login" action='../php_components/ValidateEmail.php' method="post" class="form">

        <div>
            <label>Email Address:</strong></label> <br />
            <input type="text" title="Email" id="email" name="email" class="form-control"
                placeholder="Email Adrress" /> <br /> <br />
        </div>

        <div>
            <label>Password:</label> <br />
            <input type="password" title="Password" id="password" name="password" class="form-control"
                placeholder="Password" /> <br /> <br />
        </div>

        <input type="submit" class="btn btn-info" value="Login" />
    </form>
</div>
<div class="col-lg-3 col-md-3"></div>

<?php
    require '../php_components/footer.php';
?>

</body>
</html>
