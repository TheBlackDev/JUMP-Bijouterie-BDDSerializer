<!DOCTYPE html>

<html>
<head>
  <meta charset="UTF-8">
  <title>Insertion d'un nouveau produit</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>
  <link rel="stylesheet" href="css/style-form.css">

  <script src="js/form.js"></script>
 
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
                        <div class="img_wrapper"><img class="uploaded_image" src="private/media/'.$id.'" alt="default.jpg"></div>
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
      <h1 style="display: inline-block; margin-right: 30px;">Insertion d'un nouveau produit</h1> *CVD = Complétable Via la Description
    </div>
    
    <div class="form-content">
      
        <div class="form-collumn-container">
          <div class="form-collumn">
            <div class="form-group">
              <label for="lot">Lot</label>
              <input type="number" id="lot" name="lot" placeholder="Automatiquement fixé si non précisé"/>
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
              <datalist id="seller_list">
                <?php require("private/front/inc/seller_options.php") ?>
              </datalist>
            </div>
          </div>
          <div class="form-collumn">
            <div class="form-group">
              <label for="type">Type (CVD)</label>
              <input class="autofill" type="text" list="type-list" id="type" name="type" required="required" placeholder="Complétable via la description"/>
              <datalist id="type-list">
                <option value="bague">
                <option value="bo">
                <option value="colier">
                <option value="broche">
              </datalist>
              <!--Attention à compléter tous les types qui existent-->
            </div>
            <div class="form-group">
              <label for="type2">Type 2 (CVD)</label>
              <input class="autofill" type="text" list="type2-list" id="type2" name="type2" required="required" placeholder="Complétable via la description"/>
              <datalist id="type2-list">
                <option value="géométrique">
                <option value="noeud">
                <option value="créole">
                <option value="turbogaz">
              </datalist>
              <!--Attention à compléter tous les types qui existent-->
            </div>
            <div class="form-group">
              <label for="periode">Période</label>
              <input type="text" id="periode" name="periode" required="required" list="period_list"/>
              <datalist id="period_list">
                <?php require("private/front/inc/period_options.php") ?>
              </datalist>
            </div>
            <div class="form-group">
              <label for="buy_price">Marque</label>
              <input type="text" id="brand" name="brand" required="required" list="brand_list"/>
              <datalist id="brand_list">
                <?php require("private/front/inc/brand_options.php") ?>
              </datalist>
            </div>
            
          </div>
          <div class="form-collumn">

            <div class="form-group">
              <label for="metal">Métal (CVD)</label>
              <select class="autofill" id="metal" name="metal" required="required" multiple="multiple" placeholder="Complétable via la description">
                <option value="os">Or spécial</option>
                <option value="oj2">Or jaune 2</option>
                <option value="og">Or gris</option>
                <option value="or">Or rose</option>
                <option value="o14">Or 14k</option>
                <option value="pla">Platine</option>
                <option value="ag">Argent</option>
                <option value="aci">Acier</option>
              </select>
            </div>
            <div class="form-group">
              <label for="weight">Poids Brut (en g.) (CVD)</label>
              <input type="number" step=".01" id="weight" name="weight" required="required" placeholder="Complétable via la description"/>
            </div>
            <div class="form-group">
              <label for="pierre">Pierre (CVD)</label>
              <select class="autofill" id="pierre" name="pierre" required="required" multiple="multiple" placeholder="Complétable via la description">
                <option value="Diamant">Diamant</option>
                <option value="Emeraude">Emeraude</option>
                <option value="Saphir">Saphir</option>
                <option value="Rubis">Rubis</option>
                <option value="Aiguemarine">Aiguemarine</option>
                <option value="Perle">Perle</option>
                <option value="Autre pierre">Autre pierre</option>
              </select>
            </div>

            <div class="form-group">
              <label for="open_media">Médias</label>
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
            <input type="checkbox" id="sold" name="sold"/>
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
              <label for="sell_place">Lieu de la vente</label>
              <input type="text" id="sell_place" name="sell_place"/>
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
              <label for="omb">Oh my brooch!</label>
              <input type="text" id="omb" name="omb" />
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
              <label for="facture">Identifiant facture</label>
              <input type="text" id="facture" name="facture"/>
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
<script>
  for (let input of document.querySelectorAll('input[type="text"]')) {
      input.addEventListener("change", function(event) {
          let newValue = event.target.value;
          event.target.value = newValue.toLowerCase();
      });
  }
</script>
<script src="js/insert_autofill.js"></script>

<!-- END LOADING JS -->

</body>

</html>
