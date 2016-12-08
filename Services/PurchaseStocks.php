<?php
session_start();
require_once('../php_components/Trade.php');
$stockName = $_SESSION['stockname'];
$numberPurchased = $_POST['purchase'];
$balance = $_SESSION['balance'];
$currentPrice= $_SESSION['bid'];
$userId = $_SESSION['id'];
$totalPrice = $currentPrice * $numberPurchased;
if ($balance < $totalPrice)
{
	header("Location: ../pages/PurchaseFailure.php");
}
else
{
	$trade = new Trade();
	$purchased = $trade->buyStocks($stockName, $_SESSION['symbol'], $userId, $currentPrice, $totalPrice, $numberPurchased);
	if ($purchased)
	{
		header("Location: ../pages/view.php");
	}
	else
	{
		echo 'PurchaseStocks.php, Error';
	}
}
?>