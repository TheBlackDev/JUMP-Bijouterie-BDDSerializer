<!DOCTYPE html>

<?php $lot = $res -> lot; ?>

<html>
<head>
  <meta charset="UTF-8">
  <title>Lot <?= $lot ?></title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>
  <link rel="stylesheet" href="css/style-form-modif.css">

  <script src="js/form.js"></script>
 
</head>

<body>

  <div id="background"></div>


  
<!-- Form-->

<div id="mediamask" class="mask">
  <div id="media" class="form-attached-files">
    <div class="form-header">
      <h1>Modifier les médias</h1>
    </div>
    
    <form method="post" enctype="multipart/form-data">
      <div class="addfiles">
        <ul id="uploadedFileVis">
          <?php
            $first_img = "";
            $first = true;
            if(!empty($ids)){
              foreach ($ids as $id) {
                $ext = explode(".", $id)[1];
                $vid = array("mp4", "avi", "mkv", "mov");
                $img = array("jpg", "jpeg", "gif", "png");
                $path = '/loadMedia.php?file='.$id;
                if($first) {
                  $first_img = $path;
                  $first = false;
                }
                $str = "";

                if (in_array($ext, $vid)){
                  $str = '
                    <div class="img_wrapper">
                      <video preload="none" src="'.$path.'"'. $lot .'" controls></video>
                    </div>';
                } else if (in_array($ext, $img)){
                  $str = '
                  <div class="img_wrapper">
                    <img class="uploaded_image" src="'.$path.'" alt="default.jpg">
                  </div>';
                } else {
                  $_SESSION['flash']['error'] = "Erreur interne (Le fichier n'est pas une image ou un vidéo).";
                  #header('Location: /search.php');
                  exit();
                }
                echo '<li class="uploaded_img_li">
                        '.$str.'
                        
                        <button class="remove_uploaded_img" image_id="'.$id.'" type="button" onclick="removeimageModif(this, '.$res->lot.')">Supprimer</button>
                      </li>';
              }
            } else {
              echo '<li class="uploaded_img_li">
                      <img class="uploaded_image" src="public/ressources/no_image_available.png" alt="default.jpg">
                    </li>';
            }
          ?>
        </ul>
      </div>   

      <div class="fileinputcontainer">
        <div></div>
        <div>        
            <label class="file_label">
            <input type="file" name="file[]" class="file_input" id="file" multiple required="required">
          </label>
        </div>

      </div>

      <div class="out_buttons">
        <button type="button" value="Cancel" id="close_media" onclick="cancelmediaadd()">Annuler</button>
        <button type="submit" value="Upload" id="save_media">Ajouter</button>        
      </div>
      
    </form>
    
    

  </div>
</div>


<div class="form" style="margin-bottom: 1%;">
  <div class="form-toggle"></div>
  <form id="formid" method="post">

  <div class="form-panel one">
    <div class="form-header">
      <h1 style="display: inline-block; margin-right: 30px;">Visualisation / modification du lot <?= $lot ?></h1>
    </div>

    <?php 
    
      function checkPrice($result) {
        if ($result == "" || $result == NULL) {
          return "";
        } else {
          return $result/100;
        }
      }

    ?>
    
    <div class="form-content">
      
        <div class="form-collumn-container">
          <div class="form-collumn">
            <div class="form-group">
              <label for="lot">Lot</label>
              <input type="text" id="lot" name="lot" value="<?= $res->lot ?>" disabled/>
            </div>
            <div class="form-group">
              <label for="buy_price">Prix d'achat (en €)</label>
              <input type="number" step=".01" id="buy_price" name="buy_price" value="<?= checkPrice($res->buy_price) ?>" required="required"/>
            </div>
            <div class="form-group">
              <label for="buy_date">Date d'achat</label>
              <input type="date" id="buy_date" name="buy_date" required="required" value="<?php 
                $date = new DateTime($res->buy_date);
                echo $date->format('Y-m-d');  
              ?>"/>
            </div>
            <div class="form-group">
              <label for="seller">Vendeur</label>
              <input type="text" id="seller" name="seller" required="required" list="seller_list" value="<?= $res -> seller?>"/>
            </div>

            <div class="form-group">
              <label for="place">Confié à / Vendu à</label>
              <input type="text" id="place" name="place" value="<?= $res -> place ?>"/>
            </div>
            <div class="form-group">
              <label for="sell_price">Prix de vente (en €)</label>
              <input type="number" step=".01" id="sell_price" name="sell_price" value="<?= checkPrice($res -> sell_price) ?>"/>
            </div>
            <div class="form-group">
              <label for="sell_date">Date confié</label>
              <input type="date" id="sell_date" name="sell_date" value="<?php 
                $date = new DateTime($res->sell_date);
                echo $date->format('Y-m-d');  
              ?>"/>
            </div>

          </div>
          <div class="form-collumn">
            <div class="form-group">
              <label for="type">Type</label>
              <input type="text" list="type-list" id="type" name="type" required="required" value="<?= $res -> type?>"/>
            </div>
            <div class="form-group">
              <label for="type2">Type 2</label>
              <input type="text" list="type2-list" id="type2" name="type2" value="<?= $res -> type2?>"/>
            </div>
            <div class="form-group">
              <label for="periode">Période</label>
              <input type="text" id="periode" name="periode" list="period_list" value="<?= $res -> period ?>"/>
            </div>
            <div class="form-group">
              <label for="brand">Marque</label>
              <input type="text" id="brand" name="brand" list="brand_list" value="<?= $res -> brand ?>"/>
            </div>
            <div class="form-group">
              <label for="omb">Oh my brooch! (Prix)</label>
              <input type="number" step=".01" id="omb" name="omb" <?php checkPrice($res -> ombprice) ?> />
            </div>
            <div class="form-group">
              <label for="ees">Ebay Etsy Sonia</label>
              <input type="text" id="ees" name="ees" value="<?= $res -> eesonia ?>"/>
            </div>
            <div class="form-group">
              <label for="eep">Prix Ebay Etsy</label>
              <input type="text" id="eep" name="eep" value="<?= checkPrice($res -> eeprice)?>"/>
              <!-- VALUE : <?= $res -> eeprice?>-->
            </div>
            
          </div>

          <?php 
          
          function getOptionProp($res, $value, $group) {
            $selected = "";
            if(in_array($value, explode('-', $res -> $group))) {
              echo("coucou");
              $selected = "selected";
            }
            return "value='$value' $selected";
          }
          
          ?>

          <div class="form-collumn">

            <div class="form-group" style="opacity:0" >
              <label for="weight" >Qui ne sert à rien</label>
              <input type="number" step=".01"/>
            </div>

            <div class="form-group">
              <label for="metal">Métal</label>
              <select id="metal" name="metal[]" multiple="multiple" placeholder="Complétable via la description">
                <?php getMetalsWithSelected($pdo, $res); ?>
              </select>
            </div>
            <div class="form-group">
              <label for="weight" >Poids Brut (en g.)</label>
              <input type="number" step=".01" id="weight" name="weight" required="required" value="<?= $res->weight ?>"/>
            </div>

            <?php 
            
            function getStoness($pdoo, $ress) {
              $req = $pdoo->prepare("SELECT stone FROM (SELECT stone, COUNT(*) AS c FROM inventory GROUP BY stone ) AS T ORDER BY c DESC");
              $req->execute();
              $res = $req->fetchAll();	
              $stones = array();
              foreach($res as $key=>$value) {
                  foreach(explode("-", $value->stone) as $stone) {
                      if(!in_array($stone, $stones)) {
                      array_push($stones, $stone);
                      }
                  }
              }
                  $stones = array_unique($stones);
              if (($key = array_search("", $stones)) !== false) {
                  unset($stones[$key]);
              }
              if (($key = array_search("NULL", $stones)) !== false) {
                  unset($stones[$key]);
              }
              sort($stones);
              foreach($stones as $stone) {
                  $selected = "";
                  if(in_array($stone, explode('-', $ress -> stone))) {
                    $selected = " selected";
                  }
                  echo('<option class="stone_option" value="'.$stone.'"'.$selected.'>'.$stone.'</option>');
              }
              return $stones;
            }

            ?>

            <div class="form-group">
              <label for="pierre">Pierre</label>
              <select id="pierre" name="pierre[]" multiple="multiple" placeholder="Complétable via la description">
                <?php $stones = getStoness($pdo, $res) ?>
              </select>
            </div>

            <div class="form-group">
              <label for="open_media">Médias</label>
              <button id="open_media" type="button" onclick="openmediaadd()">Modifier les médias</button>
              <!--<input type="file" id="picture" name="picture" disabled="disabled" placeholder="Clicker ici pour ajouter des images"/>-->
            </div>

            <div class="form-group">
              <label for="eed">Date ebay etsy</label>
              <input type="date" id="eed" name="eed" value="<?php 
                $date = new DateTime($res->eedate);
                echo $date->format('Y-m-d');  
              ?>"/>
            </div>
            <div class="form-group">
              <label for="bill">Identifiant facture</label>
              <input type="text" id="bill" name="bill" value="<?= $res -> bill ?>"/>
            </div>

          </div>

        </div>

        <?php if(!$first): ?>
          <div id="image_icon" style="position: absolute;">
            <img style="object-fit: contain; width: 100%; height: 100%; display: block;" src="<?= $first_img ?>">
          </div>
        <?php endif; ?>

        <div id="bottom-line">
          <div class="form-group">
            <label for="description" >Description</label>
            <textarea style="
              width: 100%;
              height: 100%;
              resize: none;
              overflow: auto;
              " id="description" name="description" required="required"><?= $res -> description ?></textarea>
          </div>
          <div class="form-group">
            <label for="sold" id="checkbox-label">Vendu</label>
            <input type="hidden" name="sold" value="0"/>
            <input type="checkbox" id="sold" name="sold" value="1" <?php if($res -> sold == 1) {echo("checked");}?>/>
          </div>
        </div>
        <div id="footer-line">
            <div class="link_container">
              <a href="#" onclick="window.close()" class="linkk">Fermer la page</a>
            </div>
            <div class="form-group submit">
              <button type="submit">Modifier</button>
            </div>            
            <div class="link_container">
              <a href="logout.php" class="linkk">Déconnexion</a>
            </div>
        </div>
    </div>
  </div>



  </form>

</div>

<div style="display:block; opacity: 0;">Mon super messag secret</div>

<!-- LOADING JS -->

<script src='http://codepen.io/andytran/pen/vLmRVp.js'></script>
<script src="js/index.js"></script>
<script>
  for (let input of document.querySelectorAll('input[type="text"]')) {
    if(input.name == "description"){
      continue;
    }  
    input.addEventListener("change", function(event) {
          let newValue = event.target.value;
          event.target.value = newValue.toLowerCase();
      });
  }
</script>

<script>

  let offset_x = document.getElementsByClassName('form')[0].getBoundingClientRect().left;
  let offset_y = document.getElementsByClassName('form')[0].getBoundingClientRect().top;

  let image_icon = document.getElementById("image_icon");
  image_icon.style.setProperty("top", 15 + "px");
  image_icon.style.setProperty("left", (document.getElementById('metal').getBoundingClientRect().left-offset_x) + "px");
  let height = document.getElementById('metal').getBoundingClientRect().top - offset_y - 50;
  image_icon.style.setProperty("height", height + "px");
  let width = document.getElementById('metal').getBoundingClientRect().width;
  image_icon.style.setProperty("width", width + "px");


  function closeWindow() {
    window.close();
  }

  function update_length() {
    let sel_stone = document.getElementById("pierre");
    let length = 20 + document.getElementsByClassName("stone_option")[0].offsetHeight * sel_stone.length;
    sel_stone.style.setProperty('--pierre-hover-height', (length + "px"));
  }

  update_length();


  
</script>

<!-- END LOADING JS -->

</body>

</html>
