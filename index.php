<?php 

    $weather = "";
    $error = "";
    if ($_GET) {
        $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urldecode($_GET['city'])."&appid=b01cdaf630277ee79688f717771ef348");
        $weatherArray = json_decode($urlContents, true);
        if ($weatherArray['cod'] == 502) {
            $error = "That city could not be found.";
        } else {
            $weather = "The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'.";
            $temInCelcius = round($weatherArray['main']['temp'])-273;
            $weather .= " The tempreture is ".$temInCelcius."&deg;C and the wind speed is ".$weatherArray['wind']['speed']." m/s";
        }
    }

?>

<!DOCTYPE html>
<html lang="fa">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <title>Weather Scraper</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
    
    <style type="text/css">
      html {
        background: url(wbg.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }
      body {
        background: none;
      }
      .container {
        margin-top: 4rem;
      }
      h1, #label {
        color: #fff;
      }
      #weather {
        margin-top: 1rem;
      }
      
    </style>
  </head>
  <body>

    <div class="container text-xs-center col-xs-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
      <h1>What's The Weather?</h1>
      <form>
        <fieldset class="form-group">
          <label for="city" id="label">Enter the name of the city.</label>
          <input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Tokyo, Tehran" value="<?php 
            if (array_key_exists('city', $_GET)) {
              echo $_GET['city'];
            }
          ?>">
        </fieldset>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <div id="weather"><?php 

      if ($weather) {
        echo '<div class="alert alert-success" role="alert"> '. $weather .'  </div>';
      } else if ($error) {
        echo '<div class="alert alert-danger" role="alert"> '. $error .'  </div>';
      }

      ?></div>  
    </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script>
  </body>
</html>
