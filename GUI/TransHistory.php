<?php
	session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Account</title>
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

<?php
  require('../php_components/connect.php');

  if (isset($_SESSION['email']))
    {
      echo '<nav class="navbar navbar-default">';
        echo '<div class="container-fluid">';
          echo '<ul class="nav navbar-nav navbar-left">';
            echo '<li><a href="../index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>';
            echo '<li><a href="twitter.php"><span class="glyphicon glyphicon-stats"></span> Twitter</a></li>';
            echo '<li><a href="nyt.php"><span class="glyphicon glyphicon-list"></span> View New York Times Headlines</a></li>';
            echo '<li><a href="view.php"><span class="glyphicon glyphicon-ok"></span> View Portfolio</a></li>';
            echo '<li><a href="stockinfo.php"><span class="glyphicon glyphicon-stats"></span> Look Up Stock Information</a></li>';
            echo '<li><a href="TransHistory.php"><span class="glyphicon glyphicon-home"></span> Transaction History</a></li>';
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
            echo '<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
          echo '</ul>';
        echo '</div>';
      echo '</nav>';
    }
?>

<div class="col-lg-3 col-md-3"></div>
<div class="col-lg-6 col-md-6">
<div class="panel panel-default">
  <?php 
    require_once('../php_components/Account.php');
    $userId = $_SESSION['id'];
	$account = new Account();
	$transactions = $account->transHistory($userId);
  ?>
  </span></h3>
<div class="panel-heading">Buy/Sell History</div>
  <table class="table">
  <thead class="thead-inverse">
    <th>Date/Time</th>
    <th>Stock Symbol</th>
    <th>Stock Description</th>
    <th>Quantity</th>
    <th>Purchase Price</th>
    <th>Sell Price</th>
  </thead>
      <?php
        foreach($transactions as $key=>$value)
        {
          echo '<tr>';
          echo '<td>' . $value[2] . '</td>';
          echo '<td>' . $value[3] . '</td>';
          echo '<td>' . $value[4] . '</td>';
          echo '<td>' . $value[5] . '</td>';
          echo '<td>' . $value[6] . '</td>';
          echo '<td>' . $value[7] . '</td>';
          echo '</tr>';
          //echo '<br></br>';
        }
      ?>
  </table>
</div>
</div>
<div class="col-lg-3 col-md-3"></div>

<?php
  //require '../php_components/footer.php';
?>

</body>
</html>
