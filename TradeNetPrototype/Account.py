import sqlite3
	
class Account:
	def __init__(self, accountID, email, password, accountBalance):
		self.accountID = accountID
		self.email = email
		self.password = password
		self.accountBalance = accountBalance

	def addFunds(self, amount):
		self.accountBalance += amount
		conn = sqlite3.connect('tradeNet.db')
		c = conn.cursor()
		c.execute('''UPDATE users SET balance = ? WHERE uid = ?''', (self.accountBalance, self.accountID))
		conn.commit()
		conn.close()

	def getAccountBalance(self):
		conn = sqlite3.connect('tradeNet.db')
		c = conn.cursor()
		c.execute('''SELECT balance from users WHERE uid = ?''', (self.accountID,))
		return self.accountBalance