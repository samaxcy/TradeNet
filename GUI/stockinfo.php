<!--tradierclass.php
    User enters stock symbol, connection made to Tradier API, returns information about stock
-->
<?php
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Stock Information</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>

<?php
  require 'header.php';
  require('../php_components/connect.php');
  require '../php_components/tradier_class.php';

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

if (isset($_POST["symbol"]))
{
    $symbol = $_POST["symbol"];
    $tradier_obj = new Tradier;
    $stockData = $tradier_obj->getStockData($symbol);
    //var_dump($array);
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
    </div>
    <div class="panel panel-default">
    <div class="panel-heading"><b>Stocks Owned</b></div>
      <table class="table">
      <thead class="thead-inverse">
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
              $investment = $value[5] * $value[3];
              echo '<tr>';
              echo '<td>' . $value[6] . '</td>';
              echo '<td>' . $value[1] . '</td>';
              echo '<td>' . $value[2] . '</td>';
              echo '<td>$' . number_format($value[3], 2) . '</td>';
              echo '<td>' . $value[5] . '</td>';
              echo '<td>$' . number_format($investment, 2) . '</td>';
              echo '<td>$' . number_format($currentPrice, 2) . '</td>';
              echo '<td>$' . number_format((($currentPrice * $value[5]) - $investment), 2) . '</td>';
              echo '</tr>';
            }
          ?>
      </table>
    </div>
    </div>
    </div>
    <div class="col-lg-3 col-md-3"></div>
    <div class="col-lg-6 col-md-6">
    <div class="panel panel-default">
    <table class="table">
    <thead class="thead-inverse">
      <th>Stock Symbol</th>
      <th>Stock Description</th>
      <th>Change</th>
      <th>Current Price</th>
    </thead>
      <?php
        echo '<tr>';
        foreach($stockData as $key=>$value)
        {
          if ($key == 'description')
          {
            $_SESSION['stockname'] = $value;
          }
          if ($key == 'bid')
          {
            $_SESSION['bid'] = $value;
          }
          if ($key == 'symbol')
          {
            $_SESSION['symbol'] = $value;
          }
          echo '<td>' . $value . '</td>';
        }
        echo '</tr>';
      ?>
      </table>
    </div>
    <form name="purchasestocks" action='../php_components/PurchaseStocks.php' method="post" class="form">
      <div>
      <input type="text" title="Purchase" id="purchase" name="purchase" class="form-control"
                  placeholder="# of stocks" /></br>
      <input type="submit" class="btn btn-info" value="Purchase" />
      </div>
    </form>
    </div>
    <div class="col-lg-3 col-md-3"></div>
    <br><br>
    <?php
}

else
{
    ?>
    <h2>Stock search</h2>
    <hr></hr>
    <div class="col-lg-3 col-md-3"></div>
    <br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Enter Stock Symbol</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="stockinfo.php">  
                                <br><br>
                                    <input type="text" size="35" name="symbol" value="">
                                <br><br>
                                
                                <input type="submit" name="submit" value="Find Info"> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class='row'>
    <div class='col-lg-1 col-md-1'></div>
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
    </div>
    <div class="panel panel-default">
    <div class="panel-heading"><b>Stocks Owned</b></div>
      <table class="table">
      <thead class="thead-inverse">
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
              echo '<td>' . $value[6] . '</td>';
              echo '<td>' . $value[1] . '</td>';
              echo '<td>' . $value[2] . '</td>';
              echo '<td>$' . number_format($value[3], 2) . '</td>';
              echo '<td>' . $value[5] . '</td>';
              echo '<td>$' . number_format($initialInvestment, 2) . '</td>';
              echo '<td>$' . number_format($currentPrice, 2) . '</td>';
              echo '<td>$' . number_format((($currentPrice * $value[5]) - $initialInvestment), 2) . '</td>';
              echo '</tr>';
            }
          ?>
      </table>
    </div>
    </div>
    </div>
    <div class='col-lg-2 col-md-2'></div>
    </div>
    <?php
}  
    ?>

</body>

</html>

