<?php
session_start();
require_once('../php_components/Trade.php');
$stockId = $_POST['sell'];
$quantity = $_POST['quantity'];
$balance = $_SESSION['balance'];
$userId = $_SESSION['id'];

$trade = new Trade();
$trade->sellStocks($stockId, $_SESSION['symbol'], $userId, $quantity, $balance);
?>