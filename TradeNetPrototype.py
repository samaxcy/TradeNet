import json
import http.client
import requests
import twitter

class FinancialHeadlines:
	apiKey = '8f798f9710e54def9a3446df85e85744'

	def getArticles(self):
		request = 'https://api.nytimes.com/svc/topstories/v2/business.json?api-key=' + self.apiKey
		response = requests.get(request)
		articles = json.loads(response.text)
		for article in articles['results']:
			if article['section'] == 'Business Day':
				print(article['section'])
				print(article['title'])
				print(article['abstract'])
				print(article['url'])
				print("")

class Mailboxlayer:
	accessKey = "ef9eaa87c891f8ad7aa618df0ade497a"
	email = ""

	def getEmail(self):
		self.email = input("Enter an email address to validate: ")

	def formURL(self, accessKey, email):
		#Creates a URL to authenticate a specific email address.
		url = "https://apilayer.net/api/check?access_key={}&email={}".format(accessKey, email)
		return url

	def verifyEmail(self, url):
		#Gets JSON data from the Mailboxlayer API for a specific email.
		result = requests.get(url)
		print("Email entered: " + result.json()['email'])
		print("Format is valid: " + str(result.json()['format_valid']))
		print("MX records found: " + str(result.json()['mx_found']))

class TradierObj:
	# Request: Market Quotes (https://sandbox.tradier.com/v1/markets/quotes?symbols=spy)
	def __init__(self):
		self.connection = http.client.HTTPSConnection('sandbox.tradier.com', 443, timeout = 30)

		# Headers
		self.headers = {"Accept":"application/json",
		"Authorization":"Bearer IkfHbyuz5JV5MIFOGndB0DZT4b70"}

	def get_company_info(self):
		company = input("Insert Stock Symbol for Company: ")
		theurl = '/v1/markets/quotes?symbols='+company

		self.connection.request('GET',theurl,None, self.headers)
		response = self.connection.getresponse()
		content = response.read()
		# Success
		data_list_json=json.loads(content.decode("utf-8"))
		# Success
		#print('Response status ' + str(response.status))
		#print(data_list_json)
		try:
			name = (data_list_json['quotes']['quote']['description'])
			stockchange = (data_list_json['quotes']['quote']['change'])
			currentbid =(data_list_json['quotes']['quote']['bid'])
			return name,stockchange,currentbid
		except Exception: 
			print("No results found")

class Twitter:
	def __init__(self):
		# Setting up Twitter API
		self.api = twitter.Api(consumer_key='HFABXNNBTqS5gxXnHHu9g4L9L',consumer_secret='QqDHdz0TDWDYc5FValYfFW8pRT1TizQwVQGe1mv4vMM60lwwwA', access_token_key='793545491485253632-Nt0oRGb91sjDy2Pr9UsNm91N61vr58d',access_token_secret='zwh5MX9asmftK0sk7HsPUB72Ms1cmpncOdWOf2s98p60F')

	def getStockName(self):
		# Enter search criteria
		searchTopic = input('Search: ')
		self.stockSearch = "$" + searchTopic

	def twitterSearch(self):
		# simple twitter search
		try:
			search = self.api.GetSearch(term=self.stockSearch, lang='en', result_type='recent', count=100, max_id='')
			return search
		except TypeError:
			print("Error! No results found")

	def displayResults(self, searchterm):
		for t in searchterm:
			print(t.user.screen_name + ' (' + t.created_at + ')')
			# Add the .encode to force encoding
			print(t.text.encode('utf-8'))
			print('')

def main():
	print("Welcome to TradeNet!")
	# Enter program control loop
	exit_code = 1
	while exit_code != 0:
		print("\nTo view , enter TR")
		print("To validate an email address, enter MB")
		print("To search Twitter for stock related info, enter TW")
		print("To view top business/financial headlines, enter HL")
		print("To quit, enter Q")
		choice = str(input())
		if choice.upper() == 'TR':
			obj= TradierObj()
			result = obj.get_company_info()
			print(result)
		elif choice.upper() == 'MB':
		    obj = Mailboxlayer()
		    obj.getEmail()
		    url = obj.formURL(obj.accessKey, obj.email)
		    obj.verifyEmail(url)
		elif choice.upper() == 'TW':
		    obj = Twitter()
		    obj.getStockName()
		    result = obj.twitterSearch()
		    obj.displayResults(result)
		elif choice.upper() == 'HL':
			obj = FinancialHeadlines()
			obj.getArticles()
		elif choice.upper() == "Q":
			exit_code = 0
		else:
			print("Error, incorrect command entered")

main()