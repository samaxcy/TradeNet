<?php
require("tradier_class.php");
require("connect.php");

class Trade
{
	public function buyStocks($stockName, $stockSymbol, $userId, $purchasePrice, $totalPrice, $stocksPurchased)
	{
        	global $db;
                //get user information
        	$query = $db->prepare('SELECT * FROM users WHERE id = ?');
                $query->execute(array($userId));
                //get all stocks owned by user
                $user = $query->fetch(PDO::FETCH_ASSOC);
        	$query = $db->prepare('INSERT INTO stocks(id, stock_symbol, stock_name, purch_price, uid, shares_owned, purch_date) VALUES (?, ?, ?, ?, ?, ?, ?)');
        	$query->execute(array(NULL, $stockSymbol, $stockName, $purchasePrice, $userId, $stocksPurchased, date("Y-m-d H:i:s")));
        	$balance = $user['balance'] - $totalPrice;
        	$query = $db->prepare('UPDATE users SET balance = ? WHERE id = ?');
        	$success = $query->execute(array($balance, $userId));
                if ($success)
                {
                        $purchased = true;
                        $query = $db->prepare('INSERT INTO trade_history(trans_id, uid, trans_date, stock_symbol, stock_name, quantity, purch_price, sell_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
                        $query->execute(array(NULL, $userId, date("Y-m-d H:i:s"), $stockSymbol, $stockName, $stocksPurchased, $purchasePrice, NULL));
                }
                else
                {
                        $purchased = false;
                }
                return $purchased;
	}

        public function sellStocks($stockId, $stockSymbol, $userId, $quantity, $balance)
        {
                global $db;
                $query = $db->prepare('SELECT * FROM users WHERE id = ?');
                $query->execute(array($userId));
                $user = $query->fetch(PDO::FETCH_ASSOC);
                $query = $db->prepare('SELECT * FROM stocks WHERE id = ?');
                $query->execute(array($stockId));
                $stocks = $query->fetch(PDO::FETCH_ASSOC);
                $stocksOwned = $stocks['shares_owned'];
                if ($quantity > $stocksOwned)
                {
                        header("Location: ../pages/SellFailed.php");
                }
                else
                {
                        $tradier = new Tradier();
                        $stock = $tradier->getStockData($stocks['stock_symbol']);
                        $sellPrice = $stock['bid'];
                        $totalPrice = $sellPrice * $quantity;
                        $balance += $totalPrice;
                        $stocksOwned -= $quantity;
                        if ($stocksOwned == 0)
                        {
                                $query = $db->prepare('DELETE FROM stocks WHERE id = ?');
                                $query->execute(array($stocks['id']));
                                $query = $db->prepare('UPDATE users SET balance = ? WHERE id = ?');
                                $success = $query->execute(array($balance, $userId));
                                $query = $db->prepare('INSERT INTO trade_history(trans_id, uid, trans_date, stock_symbol, stock_name, quantity, purch_price, sell_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
                                $query->execute(array(NULL, $userId, date("Y-m-d H:i:s"), $stocks['stock_symbol'], $stocks['stock_name'], $quantity, NULL, $sellPrice));
                                header("Location: ../pages/view.php");
                        }
                        else
                        {
                                $query = $db->prepare('UPDATE stocks SET shares_owned = ? WHERE id = ?');
                                $query->execute(array($stocksOwned, $_POST['sell']));
                                $query = $db->prepare('UPDATE users SET balance = ? WHERE id = ?');
                                $success = $query->execute(array($balance, $userId));
                                
                                $query = $db->prepare('INSERT INTO trade_history(trans_id, uid, trans_date, stock_symbol, stock_name, quantity, purch_price, sell_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
                                $query->execute(array(NULL, $userId, date("Y-m-d H:i:s"), $stocks['stock_symbol'], $stocks['stock_name'], $quantity, NULL, $sellPrice));
                                header("Location: ../pages/view.php");
                        }
                }
        }
}

?>