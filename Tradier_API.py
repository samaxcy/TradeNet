
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









#
#
#
# def view_top_rated():
#     conn.request("GET", "/3/movie/top_rated?page=1&language=en-US&api_key=9d3c8941bb5a7d5abef3326b3cd2cab8", payload, headers)
#
#     res = conn.getresponse()
#     data = res.read()
#     data_list_json=json.loads(data.decode("utf-8"))
#     top_rated_movie_list=[]
#     top_rated_release_date=[]
#     for n in data_list_json["results"]:
#         top_rated_movie_list.append(n["title"])
#         top_rated_release_date.append(n["release_date"])
#
#
#     for m in range(len(top_rated_movie_list)):
#         print(top_rated_movie_list[m]+" , "+top_rated_release_date[m])
#
#     print("\n")
#
# def view_now_playing():
#     conn.request("GET", "/3/movie/now_playing?page=1&language=en-US&api_key=9d3c8941bb5a7d5abef3326b3cd2cab8", payload, headers)
#
#     res = conn.getresponse()
#     data = res.read()
#     data_list_json=json.loads(data.decode("utf-8"))
#     now_playing=[]
#     now_playing_release_date=[]
#
#     for n in data_list_json["results"]:
#         now_playing.append(n["title"])
#         now_playing_release_date.append(n["release_date"])
#
#     for m in range(len(now_playing_release_date)):
#         print(now_playing[m]+" , "+now_playing_release_date[m])
#     print("\n")
#
#
# def view_upcoming():
#     conn.request("GET", "/3/movie/upcoming?page=1&language=en-US&api_key=9d3c8941bb5a7d5abef3326b3cd2cab8", payload, headers)
#
#     res = conn.getresponse()
#     data = res.read()
#     data_list_json=json.loads(data.decode("utf-8"))
#     upcoming_movie_list=[]
#     upcoming_release_date=[]
#
#     for n in data_list_json["results"]:
#         upcoming_movie_list.append(n["title"])
#         upcoming_release_date.append(n["release_date"])
#
#     for m in range(len(upcoming_movie_list)):
#         print(upcoming_movie_list[m]+" , "+upcoming_release_date[m])
#     print("\n")
#
#
# def search():
#
#     #user inputs what to search
#     query=input("Enter the title of the movie you want to search for: \n")
#
#     #url cannot have spaces, so repalce spaces with %20 (from their website)
#     query= "%20".join(query.split())
#
#     #send connection request
#     conn.request("GET", "/3/search/movie?query="+query+"&language=en-US&api_key=9d3c8941bb5a7d5abef3326b3cd2cab8", payload, headers)
#     res = conn.getresponse()
#     data = res.read()
#     data_list_json=json.loads(data.decode("utf-8"))
#     upcoming_movie_list=[]
#     upcoming_release_date=[]
#
#     for n in data_list_json["results"]:
#         upcoming_movie_list.append(n["title"])
#         upcoming_release_date.append(n["release_date"])
#
#     for m in range(len(upcoming_movie_list)):
#         print(upcoming_movie_list[m]+" , "+upcoming_release_date[m])
#     print("\n")
#
#
# #Start of main
#
#
# #create connection to database...Define strings
# conn = http.client.HTTPSConnection("api.themoviedb.org")
#
# api_key='IkfHbyuz5JV5MIFOGndB0DZT4b70'
# payload = "{}"
#
# #My login info fo TMDB
# username="kee101"
# password="js7623"
#
#
# headers = { 'content-type': "application/json" }
# user_or_guest=0
#
# #Loop until user enters either 1 or 2
# while(user_or_guest!="1"):
#     user_or_guest=str(input("Are you a \n1.user \nor \n2.guest\n"))
#
#     #connect as user
#     if (user_or_guest=="1"):
#
#
#         #create request token
#         conn.request("GET", "/3/authentication/token/new?api_key=9d3c8941bb5a7d5abef3326b3cd2cab8", payload, headers)
#
#
#         #read data back
#         res = conn.getresponse()
#         data = res.read()
#
#         #turn data into json
#         data_list_json=json.loads(data.decode("utf-8"))
#
#         #read json back. it is like a dictionary
#         request_token = (data_list_json["request_token"])
#
#         #validate the request_token
#         validate_url= '/3/authentication/token/validate_with_login?request_token='+request_token+'&password='+password+'&username='+username+'&api_key=9d3c8941bb5a7d5abef3326b3cd2cab8'
#         conn.request("GET", validate_url, payload, headers)
#
#         res = conn.getresponse()
#         data = res.read()
#
#
#         #create session
#         create_session_url= "/3/authentication/session/new?request_token="+request_token+"&api_key=9d3c8941bb5a7d5abef3326b3cd2cab8"
#         #x=input("A url should have opened. Allow access on the web browser, then hit enter")
#         conn.request("GET", create_session_url, payload, headers)
#
#         res = conn.getresponse()
#         data = res.read()
#
#         print("\n\nSuccessfully logged in as "+ username+"\n\n")
#
#
#     #connect as guest
#     elif (user_or_guest=="2"):
#         input("Sorry, guests are not allowed to access the database at this time")
#
#     else:
#         print("Please enter 1 or 2")
#
#
# user_choice = 0
#
# while (user_choice!="5"):
#     user_choice= input("Would you like to ..\n 1. View Top Rated \n 2. View Now Playing \n 3. View Upcoming \n 4. Search Movies \n 5. Quit \n ")
#     if (user_choice=="1"):
#         view_top_rated()
#     elif (user_choice =="2"):
#         view_now_playing()
#     elif (user_choice =="3"):
#         view_upcoming()
#     elif (user_choice=="4"):
#         search()
#     elif(user_choice=="5"):
#         continue
#     else:
#         print("please enter 1-4 \n")
#
# print("thanks for using our system!")
#
