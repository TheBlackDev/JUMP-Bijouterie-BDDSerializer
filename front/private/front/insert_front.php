<!DOCTYPE html>

<?php 

$request = "SELECT lot FROM inventory";
$req = $pdo->prepare($request);
$req->execute();
$results = $req->fetchAll();

$max = 0;

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
  $max = max($max, $number);
}

?>

<html>
<head>
  <meta charset="UTF-8">
  <title>Insertion d'un nouveau produit</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>
  <link rel="stylesheet" href="css/style-form.css">
 
</head>

<body>
  
<!-- Form-->

<div id="mediamask" class="mask">
  <div id="media" class="form-attached-files">
    <div class="form-header">
      <h1>Ajout de médias</h1>
    </div>
    
    <form method="post" enctype="multipart/form-data">
      <div class="addfiles">
        <ul id="uploadedFileVis">
          <?php 
            if(!empty($ids)){
              foreach ($ids as $id) {
                echo '<li class="uploaded_img_li">
                        <div class="img_wrapper"><img class="uploaded_image" src="/loadMedia.php?file='.$id.'" alt="default.jpg"></div>
                        <br>
                        <button class="remove_uploaded_img" image_id="'.$id.'" type="button" onclick="removeimage(this)">Supprimer</button>
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
        <button type="button" value="Réinitialiser la sélection" id="reset_media" onclick="resetmediaadd()">Réinitialiser</button>
        <button type="submit" value="Upload" id="save_media">Ajouter</button>        
      </div>
      
    </form>
    
    

  </div>
</div>


<div class="form">
  <div class="form-toggle"></div>
  <form id="formid" method="post">

  <div class="form-panel one">
    <div class="form-header">
      <h1 style="display: inline-block; margin-right: 30px;">Insertion d'un nouveau produit</h1> 
      <p style="display: inline-block; margin-right: 30px;">*CVD = Complétable Via la Description</p>
      <a style="margin-right: 30px; display: inline-block;  color: rgba(0,0,0,0.6);" href="#" onclick="addStone()">Ajouter une pierre</a>
      <a style="margin-right: 30px; display: inline-block;  color: rgba(0,0,0,0.6);" href="#" onclick="addMetal()">Ajouter un métal</a>
    </div>
    
    <div class="form-content">
      
        <div class="form-collumn-container">
          <div class="form-collumn">
            <div class="form-group">
              <label for="lot">Lot (proposé automatiquement)</label>
              <input type="text" id="lot" name="lot" value="<?= ($max+1) ?>"/>
            </div>
            <div class="form-group">
              <label for="buy_price">Prix d'achat (en €)</label>
              <input type="number" step=".01" id="buy_price" name="buy_price" required="required"/>
            </div>
            <div class="form-group">
              <label for="buy_date">Date d'achat</label>
              <input type="date" id="buy_date" name="buy_date" required="required"/>
            </div>
            <div class="form-group">
              <label for="seller">Vendeur</label>
              <input type="text" id="seller" name="seller" required="required" list="seller_list"/>
            </div>
          </div>
          <div class="form-collumn">
            <div class="form-group">
              <label for="type">Type (CVD)</label>
              <input class="autofill" type="text" list="type-list" id="type" name="type" required="required" placeholder="Complétable via la description"/>
              <datalist id="type-list">
                <?php getDataList($pdo, "type") ?>
              </datalist>
            </div>
            <div class="form-group">
              <label for="type2">Type 2 (CVD)</label>
              <input class="autofill" type="text" list="type2-list" id="type2" name="type2" placeholder="Complétable via la description"/>
              <datalist id="type2-list">
                <?php getDataList($pdo, "type2") ?>
              </datalist>
            </div>
            <div class="form-group">
              <label for="periode">Période (CVD)</label>
              <input class="autofill" type="text" id="periode" name="periode" list="period_list" placeholder="Complétable via la description"/>
              <datalist id="period_list">
                <?php getDataList($pdo, "period") ?>
              </datalist>
            </div>
            <div class="form-group">
              <label for="buy_price">Marque (CVD)</label>
              <input class="autofill" type="text" id="brand" name="brand" list="brand_list" placeholder="Complétable via la description"/>
              <datalist id="brand_list">
                <?php getDataList($pdo, "brand") ?>
              </datalist>
            </div>
            
          </div>
          <div class="form-collumn">

            <div class="form-group">
              <label for="metal">Métal (CVD)</label>
              <select class="autofill" id="metal" name="metal[]" multiple="multiple" placeholder="Complétable via la description">
                <?php getMetals($pdo)?>
              </select>
            </div>
            <div class="form-group">
              <label for="weight">Poids Brut (en g.) (CVD)</label>
              <input class="autofill" type="number" step=".01" id="weight" name="weight" required="required" placeholder="Complétable via la description"/>
            </div>
            <div class="form-group">
              <label for="pierre">Pierre (CVD)</label>
              <select class="autofill" id="pierre" name="pierre[]" multiple="multiple" placeholder="Complétable via la description">
                <?php $stones = getStones($pdo) ?>
              </select>
            </div>

            <div class="form-group">
              <label for="open_media">Médias <span style="font-size:0.80em;">(insérer <span style="font-size:1.1em; text-decoration:underline;">avant</span> les autres infos)</span></label>
              <button id="open_media" type="button" onclick="openmediaadd()">Ajouter des médias</button>
              <!--<input type="file" id="picture" name="picture" disabled="disabled" placeholder="Clicker ici pour ajouter des images"/>-->
            </div>
          </div>

        </div>
        <div id="bottom-line">
          <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" required="required"/>
          </div>
          <div class="form-group">
            <label for="sold" id="checkbox-label">Vendu</label>
            <input type="hidden" name="sold" value="0"/>
            <input type="checkbox" id="sold" name="sold" value="1"/>
          </div>
        </div>
        <div id="footer-line">
            <div class="link_container">
              <a href="search.php" class="linkk">Rechercher un produit</a>
            </div>
            <div class="form-group submit">
              <button type="submit">Ajouter</button>
            </div>            
            <div class="link_container">
              <a href="logout.php" class="linkk">Déconnexion</a>
            </div>
        </div>
    </div>
  </div>

  <div class="form-panel two">
    <div class="form-header">
      <h1>Informations complémentaires (optionnelles)</h1>
    </div>
    <div class="form-content">
        <div class="form-collumn-container-bis" style="
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 20px;
        ">
          <div class="form-collumn">
            <div class="form-group">
              <label for="place">Confié à / Vendu à</label>
              <input type="text" id="place" name="place"/>
            </div>
            <div class="form-group">
              <label for="sell_price">Prix de vente (en €)</label>
              <input type="number" step=".01" id="sell_price" name="sell_price" />
            </div>
            <div class="form-group">
              <label for="sell_date">Date de vente</label>
              <input type="date" id="sell_date" name="sell_date"/>
            </div>
            <div class="form-group">
              <label for="omb">Oh my brooch! (Prix)</label>
              <input type="number" step=".01" id="omb" name="omb" />
            </div>

          </div>
          <div class="form-collumn">
            <div class="form-group">
              <label for="ees">Ebay Etsy Sonia</label>
              <input type="text" id="ees" name="ees" />
            </div>
            <div class="form-group">
              <label for="eep">Prix Ebay Etsy</label>
              <input type="text" id="eep" name="eep" />
            </div>
            <div class="form-group">
              <label for="eed">Date ebay etsy</label>
              <input type="date" id="eed" name="eed" />
            </div>
            <div class="form-group">
              <label for="bill">Identifiant facture</label>
              <input type="text" id="bill" name="bill"/>
            </div>
            
          </div>

        </div>
      
    </div>
  </div>
  </form>

</div>

<!-- LOADING JS -->

<script src='http://codepen.io/andytran/pen/vLmRVp.js'></script>
<script src="js/index.js"></script>
<script src="js/form.js"></script>
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
<script src="js/insert_autofill.js"></script>

<script>
  function update_length() {
    let sel_stone = document.getElementById("pierre");
    let length = 20 + document.getElementsByClassName("stone_option")[0].offsetHeight * sel_stone.length;
    sel_stone.style.setProperty('--pierre-hover-height', (length + "px"));
  }

  update_length();

  function addStone() {
    let stone = prompt("Nom de la pierre");
    while(stone == null || stone == ""){
      stone = prompt("Nom de la pierre (merci d'entrer un nom non vide)");
    }
    let sel_stone = document.getElementById("pierre");
    let opt = document.createElement("option");
    opt.value = stone;
    opt.innerHTML = stone;
    opt.style.setProperty("font-weight", "bold");
    sel_stone.appendChild(opt);
    update_length();
  }

  function addMetal() {
    let metal = prompt("Nom du métal");
    while(metal == null || metal ==""){
      metal = prompt("Nom du métal (merci d'entrer un nom non vide)");
    }
    let sel_metal = document.getElementById("metal");
    let opt = document.createElement("option");
    opt.value = metal;
    opt.innerHTML = metal;
    opt.style.setProperty("font-weight", "bold");
    sel_metal.appendChild(opt);
    update_length();
  }
  
</script>

<!-- END LOADING JS -->

</body>

</html>
