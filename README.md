��# TradeNet

Trade Net requires Python 3.5.2 as well as a few modules. The modules used are http.client, json, twitter, and requests.
There are multiple Twitter modules so it is important install the 'python-twitter' module.
Http.clients and json modules may work by default. If they do not, they can be installed by using the command 'pip install <module>' in
command prompt.

1. Open command prompt, and use the command 'pip install python-twitter' to install the Twitter module.
2. Use the command 'pip install requests' to install the module required for HTTP requests.
3. Due to some encoding issues with the New York times API the command 'chcp 65001' must be ran in order for the headlines feature
   to work properly. This command should used before running the Trade Net prototype program.
4. Use the command 'python TradeNetPrototype.py' in order to run the program. 
5. Finally, type one of the command such as TR, TW, MB, or HL to search stocks and Twitter, validate email addresses, or view top 
   financial headlines. 
