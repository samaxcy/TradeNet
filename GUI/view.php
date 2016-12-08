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

<div class="col-lg-9 col-md-9">
<div class="panel panel-default">
  <h3> Your Current Balance: <span class="label label-default">
  <?php 
    require_once('../php_components/Account.php');
    $userId = $_SESSION['id'];
    $account = new Account();
    $_SESSION['stocks'] = $account->viewPortfolio($userId);
    $balance = $account->getAccountBalance($userId);
    $_SESSION['balance'] = $balance;
    echo '$'.number_format($_SESSION['balance'], 2); 
  ?>
  </span></h3>
  <div class="row">
  <div class="col-sm-6">
  <form name="addfunds" action='../php_components/AddFunds.php' method="post" class="form">
      <input type="text" title="Funds" id="funds" name="funds" class="form-control"
                  placeholder="Enter an amount such as 1000.00, 23.45, 453.02" /></br>
      <input type="submit" class="btn btn-info" value="Add Funds" /></br>
  </form>
  </div>
  <div class="col-sm-6">
  </div>
  </div>
</div>
<div class="panel panel-default">
<div class="panel-heading"><b>Stocks Owned</b></div>
  <table class="table">
  <thead class="thead-inverse">
    <th>Stock ID</th>
    <th>Date Purchased</th>
    <th>Stock Symbol</th>
    <th>Stock Description</th>
    <th>Purchase Price</th>
    <th>Number Owned</th>
    <th>Initial Investment</th>
    <th>Current Price</th>
    <th>Profit/Loss</th>
  </thead>
      <?php
        require_once('../php_components/tradier_class.php');
        $tradier = new Tradier();
        foreach($_SESSION['stocks'] as $key=>$value)
        {
          $stock = $tradier->getStockData($value[1]);
          $currentPrice = $stock['bid'];
          $initialInvestment = $value[5] * $value[3];
          echo '<tr>';
          echo '<td>' . $value[0] . '</td>';
          echo '<td>' . $value[6] . '</td>';
          echo '<td>' . $value[1] . '</td>';
          echo '<td>' . $value[2] . '</td>';
          echo '<td>$' . number_format($value[3], 2) . '</td>';
          echo '<td>' . $value[5] . '</td>';
          echo '<td>$' . number_format($initialInvestment, 2) . '</td>';
          echo '<td>$' . number_format($currentPrice, 2) . '</td>';
          echo '<td>$' . number_format((($currentPrice * $value[5]) - $initialInvestment), 2) . '</td>';
          echo '</tr>';
          //echo '<br></br>';
        }
      ?>
  </table>
</div>
</div>
<div>
    <div class="row">
    <div class="col-sm-9">
    <div class="panel panel-default">
    <div class="panel-heading"><b>Sell Stocks</b></div>
    <form name="addfunds" action='../php_components/SellStocks.php' method="post" class="form">
      <input type="text" title="Sellstocks" id="sell" name="sell" class="form-control"
                  placeholder="Enter a Stock ID" /></br>
      <input type="text" title="Stockquantity" id="quantity" name="quantity" class="form-control"
                  placeholder="Quantity" /></br>
      <input type="submit" class="btn btn-info" value="Sell Stocks" />
    </form>
    </div>
    <div class="col-sm-3">
    </div>
    </div>
</div>
</div>

<?php
  //require '../php_components/footer.php';
?>

</body>
</html>
