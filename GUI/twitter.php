<?php
	session_start();
?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	  <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    </head>
    <body>
    <?php
    require 'header.php';
    if (isset($_SESSION['email']))
    {
      echo '<nav class="navbar navbar-default">';
        echo '<div class="container-fluid">';
          echo '<ul class="nav navbar-nav navbar-left">';
            echo '<li><a href="../index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>';
            echo '<li><a href="twitter.php"><span class="glyphicon glyphicon-stats"></span> Twitter</a></li>';
            echo '<li><a href="nyt.php"><span class="glyphicon glyphicon-list"></span> View New York Times Headlines </a></li>';
            echo '<li><a href="view.php"><span class="glyphicon glyphicon-ok"></span> View Portfolio</a></li>';
            echo '<li><a href="stockinfo.php"><span class="glyphicon glyphicon-stats"></span> Look Up Stock Information</a></li>';
            echo '<li><a href="TransHistory.php"><span class="glyphicon glyphicon-stats"></span> Transaction History</a></li>'; //recently added
            echo '<li><a href="../php_components/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
          echo '</ul>';
        echo '</div>';
      echo '</nav>';
    }
    else
    {
      echo '<nav class="navbar navbar-default">';
        echo '<div class="container-fluid">';
          echo '<ul class="nav navbar-nav navbar-left">';
            echo '<li><a href="../index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>';
            echo '<li><a href="twitter.php"><span class="glyphicon glyphicon-stats"></span> Twitter</a></li>';
            echo '<li><a href="nyt.php"><span class="glyphicon glyphicon-list"></span> View New York Times Headlines </a></li>';
            echo '<li><a href="/pages/login.php"><span class="glyphicon glyphicon-home"></span> Login</a></li>';
          echo '</ul>';
        echo '</div>';
      echo '</nav>';
    }
    ?>

		<form method="post" style="text-align:center;">
            <label>Twitter Stock Search: $</label>
            <input type="text" name="twitter"> <br>
            <input type="submit" name="button" value="Search">
			<input type="submit" name="clearPage" value="Clear">
        </form>
		<?php
			require "../vendor/twitteroauth-0.7.1/twitteroauth-0.7.1/autoload.php";
			use Abraham\TwitterOAuth\TwitterOAuth;


			define("CONSUMER_KEY", "HFABXNNBTqS5gxXnHHu9g4L9L");
			define("CONSUMER_SECRET", "QqDHdz0TDWDYc5FValYfFW8pRT1TizQwVQGe1mv4vMM60lwwwA");
			define("ACCESS_TOKEN", "793545491485253632-Nt0oRGb91sjDy2Pr9UsNm91N61vr58d");
			define("ACCESS_TOKEN_SECRET", "zwh5MX9asmftK0sk7HsPUB72Ms1cmpncOdWOf2s98p60F");

			$conn = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);


			if(isset($_POST['clearPage'])){
				echo "";
			}
			if("" == trim($_POST['twitter']))
			{
			}
			else
			{
				function search(array $query)
				{
				  $toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
				  return $toa->get('search/tweets', $query);
				}

				$query = array(
				  "q" => "$". $_POST["twitter"],
				);

				$results = search($query);

				foreach ($results->statuses as $result) {
				  echo '<div class="row" style="margin-left: 30px; margin-right: 30px; border: 2px solid;"><h2 style="margin-left: 10px;">'. '@'.$result->user->screen_name . '</h2>';
				  echo '<div style="margin-left: 10px;"><h4>Tweet: '. $result->text . "<h4>";
				  echo"<hr>";
                  echo"<br>";
                  echo"</div></div>";
				}
				echo "</p>";
			}

		?>
	</body>
</html>
