<?php

class Tradier
{
	public function getData(){
	$sym = $_POST["symbol"];

	$url = "https://sandbox.tradier.com/v1/markets/quotes?symbols=".$sym;
	
	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Accept: application/json",
  "Authorization: Bearer IkfHbyuz5JV5MIFOGndB0DZT4b70",
	));


curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$result = curl_exec($ch);

// Failure
if ($result === FALSE)
{
  echo "cURL Error: " . curl_error($ch);
}
else
{

$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($result, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);

foreach ($jsonIterator as $key => $val) {
    if(is_array($val)) {

    } else {
    	if($key=="symbol")
    	{
    		echo"SYMBOL: $val<br><br>";
    	}
    	if($key=="description")
    	{
    		echo"DESCRIPTION: $val<br><br>";
    	}
    	if ($key == "bid")
    	{
    		echo"BID: $val<br><br>";
    	}
    }
}

}


curl_close($ch);

}
}


// Headers




if (isset($_POST["symbol"]))
	{
		$tradier_obj = new Tradier;
		$tradier_obj->getData();
		?>

		<br><br>
		<a href = "/Tradier/tradierclass.php"> CLICK HERE TO RETURN TO MAIN PAGE </a>

	<?php
	}

else{



	?>
	<form method="post" action="tradierclass.php">  
            <br><br>
           	Symbol: <input type="text" size="35" name="symbol" value="">
            <br><br>
            
            <input type="submit" name="submit" value="Calculate">
        </form>
	<?php
	}
?>

