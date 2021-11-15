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
  <div class="form-panel one">
    <div class="form-header">
      <h1>Insertion d'un nouveau produit</h1>
    </div>
    <div class="form-content">
      <form id="formid" method="post">
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
              <input type="text" list="metal-list" id="metal" name="metal" required="required"/>
              <datalist id="metal-list">
                <option value="Or spécial">
                <option value="Or jaune">
                <option value="Or gris">
                <option value="Or rose">
              </datalist>
            </div>
            <div class="form-group">
              <label for="weight">Poids Brut (en g.)</label>
              <input type="number" value="0" step=".01" id="weight" name="weight" required="required"/>
            </div>
            <div class="form-group">
              <label for="pierre">Pierre</label>
              <input type="text" list="pierre-list" id="pierre" name="pierre" required="required"/>
              <datalist id="pierre-list">
                <option value="Diamant">
                <option value="Emeraude">
                <option value="Saphir">
                <option value="Rubis">
                <option value="Aiguemarine">
                <option value="Perle">
                <option value="Autre pierre">
              </datalist>
            </div>
            <div class="form-group">
              <label for="picture">Photo</label>
              <input type="file" id="picture" name="picture" required="required"/>
            </div>
          </div>

        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" id="description" name="description" required="required"/>
        </div>
        <div class="form-group submit">
            <button type="submit">Envoyer</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require './inc/footer.php'; ?>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='http://codepen.io/andytran/pen/vLmRVp.js'></script>
    <script src="js/index.js"></script>
    <script src="js/form.js"></script>

</body>
</html>