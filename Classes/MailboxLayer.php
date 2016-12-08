<?php
class Mailboxlayer
{
  private $email = "";
  private $accessKey = "ef9eaa87c891f8ad7aa618df0ade497a";

  #The constructor requires an email and access key to be passed in as arguments.
  public function __construct($ea){
    $this->email = $ea;
  }
  
  #Creates a Mailboxlayer URL to validate an email.
  public function formURL(){
    $url = "https://apilayer.net/api/check?access_key=".$this->accessKey."&email=".$this->email;
    return $url;
  }
  
  #Accesses the email-specific URL and strips down the returned JSON data.
  public function verifyEmail(){
    //$json = fopen($this->formURL(), 'r');
    $ch = curl_init($this->formURL());
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $json = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($json, true);
    #I've assumed these 5 fields would be most useful in determining which emails are valid.
    #These can change as we see fit.
    /*$finalresult['email'] = $result['email'];
    $finalresult['format_valid'] = $result['format_valid'];
    $finalresult['disposable'] = $result['disposable'];
    $finalresult['free'] = $result['free'];
    $finalresult['score'] = $result['score'];*/ #range from 0.00 to 1.00, rates how likely this is a 'real' email
    //echo $finalresult['email'];
    //echo $finalresult['score'];
    if (($result['score'] < 0.5)||($result['format_valid']==false)||($result['disposable']==true))
    {
      $valid = false;
    } 
    else 
    {
      $valid = true;
      //echo "yes";
    }
    return $valid;
  }
}
?>