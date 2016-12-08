<?php
session_start();
require_once('../php_components/Account.php');
$userId = $_SESSION['id'];
$funds = $_POST['funds'];
$currentBalance = $_SESSION['balance'];

$account = new Account();
$fundsAdded = $account->addFunds($userId, $funds, $currentBalance);
if ($fundsAdded)
{
	header("Location: ../pages/view.php");
}
else
{
	echo "ERROR YO";
}
?>
