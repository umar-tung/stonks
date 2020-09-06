<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Stonks!</title>
  </head>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
  <?php
    require_once __DIR__.'/vendor/autoload.php';
    require __DIR__.'/api_call.php'; 
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $api_key = $_ENV['API_KEY'];
    $api_url = $_ENV['API_URL'];
    $stock = "";
    $function = "TIME_SERIES_MONTHLY";
    $stock_data = "";
    $response="";
    $api_request_url = "";
    $another_response = "";
    $dates=array();
    $open=array();
    $high=array();
    $low=array();
    $close=array();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $stock = $_POST["stock"];
      $api_request_url = $api_url."?"."function=".$function."&symbol=".$stock."&apikey=".$api_key;
      $response = file_get_contents($api_request_url);
      $response_arr = json_decode($response, true);
      $monthly_data = $response_arr["Monthly Time Series"];
      $i=0; 
      foreach($monthly_data as $date => $value){
        $dates[]=$date;
        $open[]= $value["1. open"];
        $high[]= $value["2. high"];
        $low[]= $value["3. low"];
        $close[]= $value["4. close"];
        $i++;
        if($i===12){
          break;
        }        
      }     
       
       
    }
  ?>
  <body>
    <h1>Stonks Graphs</h1>
    <form method="post" action="">
     Stock code: <input type="text" name="stock" value="<?php echo $stock;?>"
    <input type="submit" value="submit"> 

    </form>
    <p>The api url: <?=$api_url?></p>
    <p>The api key: <?=$api_key?></p>
    <p>The request url: <?=$api_request_url?></p>
    <div class="container">
      <canvas id="myChart" width="100" height="100"></canvas>
    </div> 
    <script> 
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: [<?php foreach(array_reverse($dates) as $date){echo "\"".$date."\"".',';}?>],
          datasets: [
            {
              label: 'open',
              data: [<?php foreach(array_reverse($open) as $value){echo $value.',';}?>],
              fill: false,
              borderColor: "rgb(75,192,192)"
            },
            {
              label: 'close',
              data: [<?php foreach(array_reverse($close) as $value){echo $value.',';}?>],
              fill: false,
              borderColor: "rgb(75,100,100)"
            },
            {
              label: 'high',
              data: [<?php foreach(array_reverse($high) as $value){echo $value.',';}?>],
              fill: false,
              borderColor: "rgb(205,226,192)"
            },
            {
              label: 'low',
              data: [<?php foreach(array_reverse($low) as $value){echo $value.',';}?>],
              fill: false,
              borderColor: "rgb(0,0,255)"
            },
              
          ],
        }
      });
    </script>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
