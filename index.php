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
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $stock = $_POST["stock"];
      $api_request_url = $api_url."?"."function=".$function."&symbol=".$stock."&apikey=".$api_key;
      $response = file_get_contents($api_request_url);
       
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
    <p>The stock data: <?=$stock_data?></p>
    <p>The request url: <?=$api_request_url?></p>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
