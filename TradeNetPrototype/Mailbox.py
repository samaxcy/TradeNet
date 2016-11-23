import requests

def main():
    print("Start")
    obj = Mailboxlayer()
    url = obj.formURL(obj.accessKey, obj.email)
    result = obj.verifyEmail(url)
    print(result)
    print("Finish")

class Mailboxlayer:
    accessKey = "ef9eaa87c891f8ad7aa618df0ade497a"
    email = "zak35@msstate.edu"

    def formURL(self, accessKey, email):
        #Creates a URL to authenticate a specific email address.
        url = "https://apilayer.net/api/check?access_key={}&email={}".format(accessKey, email)
        return url

    def verifyEmail(self, url):
        #Gets JSON data from the Mailboxlayer API for a specific email.
        result = requests.get(url)
        result = [result.json()['email'], result.json()['format_valid'], result.json()['disposable'], result.json()['free'], result.json()['score']]
        return result

if __name__ == '__main__':
    main()