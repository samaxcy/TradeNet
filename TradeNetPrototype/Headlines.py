# May need to use 'chcp 65001' in cmd in order for this to work due to encoding problems

import json
import requests

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