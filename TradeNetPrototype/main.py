import sqlite3
from Account import Account
import Headlines
import Mailbox
from Tradier import Tradier
import TwitterClass


def main():
    print("Welcome to TradeNet!")
    email = input("Enter your email: ")
    password = input("Enter your password: ")
    conn = sqlite3.connect('tradeNet.db')
    conn.row_factory = sqlite3.Row
    rows = conn.execute('''SELECT * from users WHERE email = ? AND pass = ?''', (email, password,))
    if rows:
        for row in rows:
            account = Account(row['uid'], row['email'], row['pass'], row['balance'])
    else:
        print("No accounts found")

    # print(account.getAccountBalance())
    print("1: Add account funds")
    print("2: Check balance")
    print("3: Trade")
    action = input("> ")
    if action == '1':
        amount = input("Deposit amount: ")
        account.addFunds(float(amount))
    elif action == '2':
        print(account.getAccountBalance())
    elif action == '3':
        print("1: View your stocks")
        print("2: Buy stocks")
        print("3: Sells stocks")
        action = input("> ")
        # if action == '1':
        # buy
        # sell
    else:
        print("error")


main()
