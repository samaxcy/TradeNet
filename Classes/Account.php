<?php
require("connect.php");

class Account
{
    private $accountId;
    private $email;
    private $password;
    private $accountBalance;

    public function __construct()
    {
        $this->email = $_POST['email'];
        $this->password = $_POST['password'];
    }

    public function addFunds($userId, $amount, $balance)
    {
        global $db;
        $balance += $amount;
        $query = $db->prepare('UPDATE users SET balance = ? WHERE id = ?');
        $funds = $query->execute(array($balance, $userId));
        if ($funds)
        {
            $fundsAdded = true;
        }
        else
        {
            $fundsAdded = false;
        }

        return $fundsAdded;
    }

    public function getAccountBalance($userId)
    {
        global $db;
        $query = $db->prepare('SELECT balance FROM users WHERE id = ?');
        $query->execute(array($userId));
        $user = $query->fetch(PDO::FETCH_ASSOC);
        $balance = $user['balance'];
        return $balance;
    }

    public function viewPortfolio($userId)
    {
        global $db;
        $query = $db->prepare('SELECT * FROM stocks WHERE uid = ?');
        $query->execute(array($userId));
        $result = $query->fetchAll();
        return $result;
    }

    public function transHistory($userId)
    {
        global $db;
        $query = $db->prepare('SELECT * FROM trade_history WHERE uid = ?');
        $query->execute(array($userId));
        $result = $query->fetchAll();
        return $result;
    }

    public function login()
    {
        global $db;
        $query = $db->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
        $query->execute(array($this->email, $this->password));
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if ($user)
        {
            echo "Successful Login";
            $this->accountId = $user['id'];
            $this->email = $user['email'];
            $this->password = $user['password'];
            $this->accountBalance = $user['balance'];
            $success = true;
        }
        else
        {
            echo "User not in database";
            $success = false;
        }

        return $success;
    }

    //public function setAccountId() { }

    public function getPassword() { return $this->password; }
    public function getAccountId(){ return $this->accountId; }
    public function getEmail(){ return $this->email; }
}

?>