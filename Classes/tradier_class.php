<?php

class Tradier
{
	public function getStockData($symbol)
  {
  	$sym = $symbol;

  	$url = "https://sandbox.tradier.com/v1/markets/quotes?symbols=".$sym;

  	$ch = curl_init($url);

  	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Accept: application/json",
    "Authorization: Bearer IkfHbyuz5JV5MIFOGndB0DZT4b70",
  	));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $result = curl_exec($ch);
    //var_dump($result);

    // Failure
    if ($result === FALSE)
    {
        $ay=curl_error($ch);
        echo $ay;
        $by=curl_errno($ch);
        echo $by;
    }
    else
    {
      $jsonIterator = new RecursiveIteratorIterator(
          new RecursiveArrayIterator(json_decode($result, TRUE)),
          RecursiveIteratorIterator::SELF_FIRST);
      //var_dump($jsonIterator);
      $stockInfo = array();
      foreach ($jsonIterator as $key => $val) 
      {
        //$stockInfo[$key] = $val;
        if($key=="symbol")
        {
          $stockInfo[$key] = $val; 
        }
        if($key=="description")
        {
          $stockInfo[$key] = $val;  
        }
        if ($key == "change")
        {
          $stockInfo[$key] = $val;
          //$bid = $val;
        }
        if($key=="bid")
        {
          $stockInfo[$key] = $val;
        }      
      }   
    }
    curl_close($ch);
    return $stockInfo;
  }
}
?>
