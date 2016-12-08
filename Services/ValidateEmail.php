<?php

require_once('../php_components/MailboxLayer.php');
require_once('../php_components/Account.php');
require_once('../php_components/connect.php');
$ea = $_POST['email'];
$mbl = new Mailboxlayer($ea);
$valid = $mbl->verifyEmail();

if ($valid)
{
	$account = new Account();
	$success = $account->login();
	//var_dump($success);
	if ($success)
	{
		session_start();
		$_SESSION['id'] = $account->getAccountId();
		$_SESSION['email'] = $account->getEmail();
		//$_SESSION['balance'] = $account->getAccountBalance();
		//$_SESSION['stocks'] = $account->viewPortfolio();
		header("Location: ../pages/view.php");
	}
}
else
{
	header("Location: ../pages/loginFailed.php");
}

?>
