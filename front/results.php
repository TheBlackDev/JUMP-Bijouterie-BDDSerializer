<?php 

require_once 'private/front/inc/db.php';
require_once 'private/front/inc/functions.php';
require_once 'private/front/inc/header.php';

if(!isset($_SESSION['auth'])){
    $_SESSION['flash']['warning'] = "Vous devez être connecté pour accéder à cette page.";
    header('Location: login.php');
    exit();
}

if(!isset($_GET)){
    $_SESSION['flash']['warning'] = "Aucune information n'a été fournie. Merci de réessayer.";
    header('Location: search.php');
    exit();
}

$pre_req = "";
if(isset($_GET["lot_max"]) && $_GET["lot_max"] != NULL) {
    $pre_req .= " AND lot <= ".$_GET["lot_max"];
} 
if(isset($_GET["lot_min"]) && $_GET["lot_min"] != NULL) {
    $pre_req .= " AND lot >= ".$_GET["lot_min"];
}
if(isset($_GET["buy_price_max"]) && $_GET["buy_price_max"] != NULL) {
    $pre_req .= " AND buy_price <= ".$_GET["buy_price_max"];
}
if(isset($_GET["buy_price_min"]) && $_GET["buy_price_min"] != NULL) {
    $pre_req .= " AND buy_price >= ".$_GET["buy_price_min"];
}
if(isset($_GET["buy_date_max"]) && $_GET["buy_date_max"] != NULL) {
    $pre_req .= " AND buy_date <= '".$_GET["buy_date_max"]."'";
}
if(isset($_GET["buy_date_min"]) && $_GET["buy_date_min"] != NULL) {
    $pre_req .= " AND buy_date >= '".$_GET["buy_date_min"]."'";
}
if(isset($_GET["seller"]) && $_GET["seller"] != NULL) {
    $pre_req .= " AND seller = '".$_GET["seller"]."'";
}
if(isset($_GET["type1"]) && $_GET["type1"] != NULL) {
    $pre_req .= " AND type1 = '".$_GET["type"]."'";
}
if(isset($_GET["type2"]) && $_GET["type2"] != NULL) {
    $pre_req .= " AND type2 = '".$_GET["type"]."'";
}



if($pre_req[0]=" ") {
  $pre_req = substr($pre_req, 1);
}


echo($pre_req."<br>");

foreach($_GET as $key => $value){
    if($value != NULL) {

    }
    echo($key . " : " . $value . "<br>");
}	
$req = $pdo->prepare('SELECT * FROM results WHERE id = ?');	

?>


<?php /*
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Résultats de recherche</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="css/style_results.css">
</head>

<body>
 
<div id="background"></div>  

<div class="tile_wrapper">  
  <div class="tile_grid">
    <div class="tile_container">
      <div class="tile_top">
        <ul class="carousel">
          <li class="image_container 0">
            <img src="temp/1.jpg" alt="aaaaaaaaaaaaaaaa">
          </li>
          <li class="image_container 1">
            <img src="temp/2.jpg" alt="bbbbbbbbbbbbbbbb">
          </li>
          <li class="image_container 2">
            <img src="temp/3.jpg" alt="cccccccccccccccc">
          </li>
          <li class="image_container 3">
            <img src="temp/4.jpg" alt="dddddddddddddddd">
          </li>
          <li class="image_container 4 video controls">
            <div class="video_container">
              <video preload="none" src="private/videos/vid1.mp4" controls></video>
              <!-- <a href="/videorequest.php?videoid" target="_blank"> <img src="public/play_button.svg" alt="play_button"> </a>-->
            </div>
          </li>
        </ul>
        <div class="tile_nav_wrapper">
          <div class="tile_nav">
            <button class="nav_dot 0 active" onclick="updateCarousselOnClick(this)"></button>
            <button class="nav_dot 1" onclick="updateCarousselOnClick(this)"></button>
            <button class="nav_dot 2" onclick="updateCarousselOnClick(this)"></button>
            <button class="nav_dot 3" onclick="updateCarousselOnClick(this)"></button>
            <button class="nav_dot 4" onclick="updateCarousselOnClick(this)"></button>
          </div>
        </div>        
      </div>
      <div class="tile_bottom">
        <h2 class="descriptionTitle">Description:</h2>
        <p class="descriptionText">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et accumsan ligula. Vestibulum a pulvinar magna. Cras commodo justo lorem, et varius velit tristique ut. Phasellus nisi nibh, vestibulum id urna eu, tristique consectetur lorem. Pellentesque mauris eros, luctus iaculis feugiat ut, venenatis id augue.  </p>
      </div>

    </div>
    
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
    <div class="tile_container">a</div>
  </div>
</div>

  


  <script src="js/results.js"></script>
  <!-- <script src='http://codepen.io/andytran/pen/vLmRVp.js'></script>
  <script src="js/index.js"></script>-->

  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>


  <script>

    Array.from(document.getElementsByClassName('carousel')).forEach(function(element) {
      element.scrollTo(0, 0);
    });

  </script>

</body>
</html>

*/ ?>