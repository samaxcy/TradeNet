

<?php

class FinancialHeadlines
{

    public function getData()
    {

        $apiKey = '8f798f9710e54def9a3446df85e85744';
        $url = 'https://api.nytimes.com/svc/topstories/v2/business.json?api-key='.$apiKey;
        $ch = curl_init($url);

        /*curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Accept: application/json",
            "Authorization: Bearer 8f798f9710e54def9a3446df85e85744"));
*/
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $result = curl_exec($ch);

        // Failure
        if (empty($result))
        {
          ?>
            error.

          <?php
        }

        else
        {
            $json = (json_decode($result, true));

						echo '<div class="container-fluid"><h1>New York Times Headlines: </h1><br>';

            foreach($json['results'] as $entry)
            {
                echo '<div class="row" style="margin-left: 30px; margin-right: 30px; border: 2px solid;"><h2 style="margin-left: 10px;">'. $entry['title'] . '</h2>';
                echo '<div style="margin-left: 10px;"><h4>New York Times Category: ' . $entry['section'] . '</h4>';
                echo"<hr>";
                echo"<br>";
                echo "<b>Summary:</b><br>";
                echo$entry['abstract'];
                echo"<br><br>";
                echo "<i>View the article here:</i><br>";
                echo '<a href="' . $entry['url'] . '">' . $entry['url'] . '</a>';
                echo"<br><br></div></div>";
            }

						echo '</div>';

        }

        curl_close($ch);

    }

}

 ?>
