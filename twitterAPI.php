<?php

require_once "autoload.php";
require "TwitterOAuth.php";

define("CONSUMER_KEY", "HFABXNNBTqS5gxXnHHu9g4L9L");
define("CONSUMER_SECRET", "QqDHdz0TDWDYc5FValYfFW8pRT1TizQwVQGe1mv4vMM60lwwwA");
define("ACCESS_TOKEN", "793545491485253632-Nt0oRGb91sjDy2Pr9UsNm91N61vr58d");
define("ACCESS_TOKEN_SECRET", "zwh5MX9asmftK0sk7HsPUB72Ms1cmpncOdWOf2s98p60F");

$conn = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

/*function search(array $query)
{
  $toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
  return $toa->get('search/tweets', $query);
}
 
$query = array(
  "q" => "happy birthday",
);
  
$results = search($query);
  
foreach ($results->statuses as $result) {
  echo $result->user->screen_name . ": " . $result->text . "\n";
}*/

?>