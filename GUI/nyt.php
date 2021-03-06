<?php
	session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Headlines</title>
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
  require '../php_components/FinancialHeadlines.php';
  require('../php_components/connect.php');

  if (isset($_SESSION['email']))
    {
      echo '<nav class="navbar navbar-default">';
        echo '<div class="container-fluid">';
          echo '<ul class="nav navbar-nav navbar-left">';
            echo '<li><a href="../index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>';
            echo '<li><a href="twitter.php"><span class="glyphicon glyphicon-stats"></span> Twitter</a></li>';
            echo '<li><a href="nyt.php"><span class="glyphicon glyphicon-list"></span> View New York Times Headlines </a></li>';
            echo '<li><a href="view.php"><span class="glyphicon glyphicon-ok"></span> View Portfolio</a></li>';
            echo '<li><a href="stockinfo.php"><span class="glyphicon glyphicon-stats"></span> Look Up Stock Information</a></li>';
            echo '<li><a href="TransHistory.php"><span class="glyphicon glyphicon-stats"></span> Transaction History</a></li>'; //recently added
            echo '<li><a href="../php_components/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
          echo '</ul>';
        echo '</div>';
      echo '</nav>';
    }
    else
    {
      echo '<nav class="navbar navbar-default">';
        echo '<div class="container-fluid">';
          echo '<ul class="nav navbar-nav navbar-left">';
            echo '<li><a href="../index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>';
            echo '<li><a href="twitter.php"><span class="glyphicon glyphicon-stats"></span> Twitter</a></li>';
            echo '<li><a href="nyt.php"><span class="glyphicon glyphicon-list"></span> View New York Times Headlines </a></li>';
            echo '<li><a href="/pages/login.php"><span class="glyphicon glyphicon-home"></span> Login</a></li>';
          echo '</ul>';
        echo '</div>';
      echo '</nav>';
    }

    ?>

<?php

$tradier_obj = new FinancialHeadlines;
$tradier_obj->getData();

?>

</body>
</html>
?>
