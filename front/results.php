<!DOCTYPE html>
<html>

<?php 

require_once 'private/front/inc/db.php';
require_once 'private/front/inc/functions.php';
require_once 'private/front/inc/header.php';

if(!isset($_SESSION['auth'])){
    $_SESSION['flash']['warning'] = "Vous devez être connecté pour accéder à cette page.";
    header('Location: /login.php');
    exit();
}


$pre_req = "";
if(isset($_GET["lot"]) && $_GET["lot"] != NULL) {
  $lot = $_GET["lot"];
} 

if(isset($_GET["buy_price_max"]) && $_GET["buy_price_max"] != NULL) {
    $pre_req .= " AND (buy_price <= ".($_GET["buy_price_max"]*100).")";
}
if(isset($_GET["buy_price_min"]) && $_GET["buy_price_min"] != NULL) {
    $pre_req .= " AND (buy_price >= ".($_GET["buy_price_min"]*100).")";
}

if(isset($_GET["sell_price_max"]) && $_GET["sell_price_max"] != NULL) {
  $pre_req .= " AND (sell_price <= ".($_GET["sell_price_max"]*100).")";
}
if(isset($_GET["sell_price_min"]) && $_GET["sell_price_min"] != NULL) {
  $pre_req .= " AND (sell_price >= ".($_GET["sell_price_min"]*100).")";
}

if(isset($_GET["buy_date_max"]) && $_GET["buy_date_max"] != NULL) {
    $pre_req .= " AND (buy_date <= '".($_GET["buy_date_max"]*100)."')";
}
if(isset($_GET["buy_date_min"]) && $_GET["buy_date_min"] != NULL) {
    $pre_req .= " AND (buy_date >= '".($_GET["buy_date_min"]*100)."')";
}

if(isset($_GET["weight_max"]) && $_GET["weight_max"] != NULL) {
    $pre_req .= " AND (weight <= ".($_GET["weight_max"]).")";
}
if(isset($_GET["weight_min"]) && $_GET["weight_min"] != NULL) {
    $pre_req .= " AND (weight >= ".($_GET["weight_min"]).")";
}

if(isset($_GET["seller"]) && $_GET["seller"] != NULL) {
    $pre_req .= " AND (seller LIKE '%".$_GET["seller"]."%')";
}

if(isset($_GET['type1']) && $_GET['type1'] != NULL) {
    $pre_req .= " AND (type LIKE '%".$_GET['type1']."%')";
}

if(isset($_GET['type2']) && $_GET['type2'] != NULL) {
    $pre_req .= " AND (type2 LIKE '%".$_GET['type2']."%')";
}

if(isset($_GET['period']) && $_GET['period'] != NULL) {
    $pre_req .= " AND (period LIKE '%".$_GET['period']."%')";
}

if(isset($_GET['brand']) && $_GET['brand'] != NULL) {
    $pre_req .= " AND (brand LIKE '%".$_GET['brand']."%')";
}

if(isset($_GET['place']) && $_GET['place'] != NULL) {
  $pre_req .= " AND (place LIKE '%".$_GET['place']."%')";
}

if(isset($_GET['description']) && $_GET['description'] != NULL) {
    $pre_req .= " AND (description LIKE '%".$_GET['description']."%')";
}

if(isset($_GET['sold']) && $_GET['sold'] != NULL) {
    $pre_req .= " AND (sold = ".$_GET['sold'].")";
}



if(isset($_GET["metal"]) && $_GET["metal"] != NULL) {
  foreach($_GET['metal'] as $met) {
    $pre_req .= " AND (metal LIKE '%".$met."%')";
  }
}

if(isset($_GET["pierre"]) && $_GET["pierre"] != NULL) {
  foreach($_GET['pierre'] as $st) {
    $pre_req .= " AND (stone LIKE '%".$st."%')";
  }
}




if($pre_req[0]=" AND ") {
  $pre_req = substr($pre_req, 5);
}

if($pre_req != '') {
  $pre_req = " WHERE ".$pre_req;
}




$req = $pdo->prepare('SELECT lot, description, media FROM inventory'.$pre_req.' ORDER BY buy_date DESC, lot DESC');
$req->execute();
$results = $req->fetchAll();

if(count($results) == 0) {
    $_SESSION['flash']['warning'] = "Aucun résultat trouvé.";
    unset($_GET['starting_item']);
    header('Location: search.php?'.http_build_query($_GET));
    exit();
}

$STARTING_ITEM = 0;
$ITEM_PER_PAGE = 50;

if(isset($_GET["starting_item"]) && $_GET["starting_item"] != NULL) {
  if($_GET["starting_item"] < 0) {
    $_GET['starting_item'] = 0;
    header('Location: /results.php?'.http_build_query($_GET));
    exit();
  }
  else if ($_GET["starting_item"] > count($results)) {
    $_GET['starting_item'] = count($results) - $ITEM_PER_PAGE;
    header('Location: /results.php?'.http_build_query($_GET));
    exit();
  }
 
  $STARTING_ITEM = $_GET["starting_item"];
}


foreach($results as $key => $value) {
  $numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
  $p = 0;
  while($p < strlen($value->lot)) {
      if(in_array($value->lot[$p], $numbers)) {
          $p++;
      } else {
          break;
      }
  }
  $number = intval(substr($value->lot, 0, $p));

  if(isset($lot) && $number != $lot) {
    unset($results[$key]);
    continue;
  }
}



?>




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


<div class="top_nav">
  <div class="top_nav_link_container">
    <a href=<?php
      unset($_GET['starting_item']);
      echo("search.php?".http_build_query($_GET));
    ?> id="correct_search" class="top_link">Modifier la recherche</a>
  </div>
  <div class="top_title_container">
    <h1 class="top_title">Résultats de la recherche</h1>
    <h2 class="top_subtitle"><?= count($results) ?> résultat(s) trouvé(s).</h2>
  </div>
  <div class="top_nav_link_container">
    <a href="search.php" id="new_search" class="top_link">Nouvelle recherche</a>
  </div>
</div>




<div class="tile_wrapper">
  <div class="tile_grid">


<!-- ITERATING THROUGH ALL RESULTS TO DISPLAY THEM -->

<?php 
$j = 0;

function getMediaIntegration($med, $i, $lot) {
  $img = array('jpg', 'jpeg', 'png', 'gif');
  $vid = array('mp4', 'avi', 'mov');
  $ext = explode(".", $med);
  $ext = $ext[count($ext)-1];
  $path = '"/loadMedia.php?file='.$med.'"';
  if(in_array($ext, $img)) {
  $str = '
    <li class="image_container '.$i.'">
      <img src='.$path.' alt="Média '. ($i + 1) .' du lot '. $lot .'">
    </li>';
    return $str;
  }
  else if(in_array($ext, $vid)) {

  $str = '
  <li class="image_container '.$i.' video controls">
    <div class="video_container">
      <video preload="none" src='.$path.' alt="Média '. ($i + 1) .' du lot '. $lot .'" controls></video>
      <!-- <a href="/videorequest.php?videoid" target="_blank"> <img src="public/play_button.svg" alt="play_button"> </a>-->
    </div>
  </li>';
    return $str;
  }
}

foreach($results as $value): 


if($j < $STARTING_ITEM) {
    $j++;
    continue;
}

?>

<div class="tile_container">

<div class="tile_top">
  <ul class="carousel">
    <?php 
      $media = $value->media;
      $media = explode(",", $media);
      $i = 0;
    
      
      foreach($media as $med) { ?>

          <?=getMediaIntegration($med, $i, $value->lot);?>


      <?php 
        $i += 1;
      }          
  
    
    ?>
  </ul>
  <div class="tile_nav_wrapper">
    <div class="tile_nav">
      <?php if($i > 0): ?>
        <button class="nav_dot 0 active" onclick="updateCarousselOnClick(this);"></button>
      <?php endif; ?>
      <?php for($k=1; $k < $i; $k++): ?>
        <button class="nav_dot <?= $k ?>" onclick="updateCarousselOnClick(this);"></button>
      <?php endfor; ?>
    </div>
  </div>
</div>


<div class="tile_bottom">
  <a class="descriptionTitle" target="_blank" href="details.php?lot=<?= $value->lot ?>">Lot <?= $value->lot ?>:</a>
  <p class="descriptionText"><?= $value -> description?></p>
</div>



</div>



<?php
$j++;
if($j >= $STARTING_ITEM+$ITEM_PER_PAGE) {
  break;
}
endforeach;

?>

  </div>
</div>
    

  <div class="bottom_nav">
    <?php if($STARTING_ITEM > 0): ?>
    <div class="link_container">
      <a href="?<?php
        $_GET['starting_item'] = max($STARTING_ITEM - $ITEM_PER_PAGE, 0);
        echo(http_build_query($_GET));
        ?> " class="linkk" id="next">Page précédente</a>
    </div>
    <?php else:?>
      <div class="link_container disabled">
        <a class="linkk disabled" id="next">Page précédente</a>
      </div>
    <?php endif; ?> 

    <div></div>

    <?php if($STARTING_ITEM+$ITEM_PER_PAGE < count($results)): ?>
    <div class="link_container">
      <a href="?<?php
        $_GET['starting_item'] = min($STARTING_ITEM + $ITEM_PER_PAGE, count($results) - $ITEM_PER_PAGE);
        echo(http_build_query($_GET));
        ?> " class="linkk" id="next">Page suivante</a>
    </div>
    <?php else:?>
      <div class="link_container disabled">
        <a class="linkk disabled" id="next">Page suivante</a>
      </div>
    <?php endif; ?>
    

  </div>
  
  <div style="opacity: 0;"> POUR AVOIR CE MARGIN! </div>


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
