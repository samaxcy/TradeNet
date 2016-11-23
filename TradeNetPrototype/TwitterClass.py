import twitter

def main():
    print("Start")
    obj=Twitter()
    obj.getStockName()
    result = obj.twitterSearch()
    obj.displayResults(result)
    print("Finish")

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
        search = self.api.GetSearch(term=self.stockSearch, lang='en', result_type='recent', count=100, max_id='')
        return search

    def displayResults(self, searchterm):
        for t in searchterm:
            print(t.user.screen_name + ' (' + t.created_at + ')')
            # Add the .encode to force encoding
            print(t.text.encode('utf-8'))
            print('')


if __name__ == '__main__':
    main()