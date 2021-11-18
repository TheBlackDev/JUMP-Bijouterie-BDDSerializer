<!DOCTYPE html>

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

<div class="form">
  <div class="form-toggle"></div>
  <form id="formid" method="post">
  <div class="form-panel one">
    <div class="form-header">
      <h1>Insertion d'un nouveau produit</h1>
    </div>
    <div class="form-content">
      
        <div class="form-collumn-container">
          <div class="form-collumn">
            <div class="form-group">
              <label for="lot">Lot</label>
              <input type="number" id="lot" name="lot" placeholder="Automatiquement précisé si non précisé"/>
            </div>
            <div class="form-group">
              <label for="buy_price">Prix d'achat (en €)</label>
              <input type="number" value="0" step=".01" id="buy_price" name="buy_price" required="required"/>
            </div>
            <div class="form-group">
              <label for="buy_date">Date d'achat</label>
              <input type="date" id="buy_date" name="buy_date" required="required"/>
            </div>
            <div class="form-group">
              <label for="seller">Vendeur</label>
              <input type="text" id="seller" name="seller" required="required"/>
            </div>
          </div>
          <div class="form-collumn">
            <div class="form-group">
              <label for="type">Type</label>
              <input type="text" list="type-list" id="type" name="type" required="required" placeholder="TODO"/>
              <datalist id="type-list">
                <option value="Bague">
                <option value="BO">
                <option value="Colier">
                <option value="Broche">
              </datalist>
              <!--Attention à compléter tous les types qui existent-->
            </div>
            <div class="form-group">
              <label for="type2">Type 2</label>
              <input type="text" list="type2-list" id="type2" name="type2" required="required" placeholder="TODO"/>
              <datalist id="type2-list">
                <option value="Géométrique">
                <option value="Noeud">
                <option value="Créole">
                <option value="Turbogaz">
              </datalist>
              <!--Attention à compléter tous les types qui existent-->
            </div>
            <div class="form-group">
              <label for="periode">Période</label>
              <input type="text" id="periode" name="periode" required="required"/>
            </div>
            <div class="form-group">
              <label for="buy_price">Marque</label>
              <input type="text" id="brand" name="brand" required="required"/>
            </div>
            
          </div>
          <div class="form-collumn">

            <div class="form-group">
              <label for="metal">Métal</label>
              <select id="metal" name="metal" required="required" multiple="multiple"/>
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
              <label for="weight">Poids Brut (en g.)</label>
              <input type="number" value="0" step=".01" id="weight" name="weight" required="required"/>
            </div>
            <div class="form-group">
              <label for="pierre">Pierre</label>
              <select id="pierre" name="pierre" required="required" multiple="multiple"/>
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
              <label for="picture">Photo</label>
              <input type="file" id="picture" name="picture" required="required"/>
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
        <div class="form-group submit">
            <button type="submit">Envoyer</button>
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
              <input type="number" value="0" step=".01" id="sell_price" name="sell_price" />
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

<script src='http://codepen.io/andytran/pen/vLmRVp.js'></script>
<script src="js/index.js"></script>
<script src="js/form.js"></script>

</body>

</html>
