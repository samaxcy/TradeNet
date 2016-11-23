# THIS SCRIPT IS MEANT TO BE RAN ONCE
# IT IS FOR PROGRAM SETUP ONLY, BUT CAN BE USED TO RESET DATA
# creates a tradeNet database, with user and portfolio tables as well as initial dummy data
#
import sqlite3 as db

# define null
null = None

# create db connection object representative of the db
# tries to connect if db exists, creates one otherwise
conn = db.connect('tradeNet.db')

# create cursor object to execute SQL commands
c = conn.cursor()


# ################# create users table
c.execute("SELECT name FROM sqlite_master WHERE type='table' AND name='users'")
tb_exists = c.fetchone()

# if table does not exist, then create
if not tb_exists:
    # create table
    c.execute('''CREATE TABLE users
                (uid integer primary key autoincrement, email text, pass text, balance real)''')

# clear existing rows for creation
c.execute("DELETE FROM users")

# set up tuples
users = [(null, 'dylanjaye@gmail.com', 'test', '100.50'),
         (null, 'samaxcy@gmail.com', 'test2', '230.47'),
         (null, 'wallstwolf@mortensaxon.com', 'test3', '5000.37'), ]

# insert users tuples
c.executemany('INSERT INTO users VALUES (?,?,?,?)', users)

# ################## create portfolio table
c.execute("SELECT name FROM sqlite_master WHERE type='table' AND name='portfolios'")
tb_exists = c.fetchone()

# if table does not exist, then create
if not tb_exists:
    # create table
    c.execute('''CREATE TABLE portfolios
                (pid integer primary key autoincrement, stockName text, shares integer, purchPrice real,
                 email text foreignkey references users(uid))''')

# clear existing rows for creation
c.execute("DELETE FROM portfolios")

# set up tuples
portfolios = [(null, 'AAPL', '50', '100.50', 'dylanjaye@gmail.com'),
              (null, 'ABC', '120', '140.50', 'dylanjaye@gmail.com'),
              (null, 'JGLC', '900', '5.30', 'samaxcy@gmail.com'),
              (null, 'DOW', '1000', '540.89', 'wallstwolf@gmail.com'), ]

# insert portfolios tuples
c.executemany('INSERT INTO portfolios VALUES (?,?,?,?,?)', portfolios)

# save changes
conn.commit()

# database has been set up
conn.close()
