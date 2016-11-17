
import json
import http.client



def main():
    obj= TradierObj()
    obj.get_company_info()

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

        name= (data_list_json['quotes']['quote']['description'])
        stockchange= (data_list_json['quotes']['quote']['change'])
        currentbid=(data_list_json['quotes']['quote']['bid'])
        return name,stockchange,currentbid

if __name__ == '__main__':
    main()







