<!DOCTYPE html>

<html>
<head>
  <meta charset="UTF-8">
  <title>Insertion d'un nouveau produit</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>

  <link rel="stylesheet" href="css/style-form-search.css">


  
  
</head>

<body>
  
<!-- Form-->

<div class="form">
  <div class="form-toggle"></div>
  <form id="formid" method="get" action="results.php">
  <div class="form-panel one">
    <div class="form-header">
      <h1 style="display: inline; margin-right: 50px;">Recherche d'un produit</h1>
      <a style="  display: inline; margin-right: 50px; color: rgba(0,0,0,0.6);" href="search.php">Effacer la recherche</a>
      <a style="  display: inline;  color: rgba(0,0,0,0.6); font-weight: bold;" href="results.php">Catalogue complet</a>
    </div>
    <div class="form-content">
      
        <div class="form-collumn-container">
          <div class="form-collumn">
            <div class="form-group">
                <label for="lot_min">Lot</label>
                <input type="number" <?php if(isset($_GET) && isset($_GET['lot']) && $_GET['lot'] != NULL) {echo('value="'.$_GET['lot'].'"');}?> step=".01" id="lot" name="lot"/>
            </div>
            <div class="form-group">
              <label for="type1">Type</label>
              <input type="text" <?php if(isset($_GET) && isset($_GET['type1']) && $_GET['type1'] != NULL) {echo('value="'.$_GET['type1'].'"');}?> class="toCheck" list="type1-list" id="type1" name="type1"/>
            </div>

            <div class="form-group">
              <label for="buy_price">Prix d'Achat Exact</label>
              <input type="number" step=".01" id="buy_price" name="buy_price"/>
            </div>

            <div class="range">
              <div class="form-group">
                <label for="buy_price_min">Prix d'Achat min</label>
                <input type="number" <?php if(isset($_GET) && isset($_GET['buy_price_min']) && $_GET['buy_price_min'] != NULL) {echo('value="'.$_GET['buy_price_min'].'"');}?> step=".01" id="buy_price_min" name="buy_price_min"/>
              </div>
              <div class="form-group">
                <label for="buy_price_max">Prix d'Achat max</label>
                <input type="number" <?php if(isset($_GET) && isset($_GET['buy_price_max']) && $_GET['buy_price_max'] != NULL) {echo('value="'.$_GET['buy_price_max'].'"');}?> step=".01" id="buy_price_max" name="buy_price_max"/>
              </div>
            </div>



          </div>
          <div class="form-collumn">

            <div class="form-group">
              <label for="metal">Métal</label>
              <select id="metal" name="metal[]"  multiple="multiple">
                <?php getMetals($pdo) ?>
              </select>
            </div>

            <div class="form-group">
              <label for="pierre">Pierre</label>
              <select id="pierre" name="pierre[]"  multiple="multiple">
                <?php $stones = getStones($pdo) ?>
              </select>
            </div>

            <div class="form-group">
              <label for="brand">Marque</label>
              <input type="text" <?php if(isset($_GET) && isset($_GET['brand']) && $_GET['brand'] != NULL) {echo('value="'.$_GET['brand'].'"');}?> id="brand" class="toCheck" name="brand"  list="brand_list"/>
            </div>




          </div>
          <div class="form-collumn">

            <div class="form-group">
              <label for="type2">Confié à / Vendu à</label>
              <input type="text" <?php if(isset($_GET) && isset($_GET['place']) && $_GET['place'] != NULL) {echo('value="'.$_GET['place'].'"');}?> class="toCheck" id="place" name="place"/>
            </div>


            <div class="form-group">
              <label for="sold">Vendu</label>
              <select id="sold" name="sold">
                <option value="">Indifférent</option>
                <option value="1">Vendu</option>
                <option value="0">Non vendu</option>
              </select>
            </div>

            <div class="form-group">
              <label for="sell_price">Prix de Vente Exact</label>
              <input type="number" step=".01" id="sell_price" name="sell_price"/>
            </div>

            <div class="range">
              <div class="form-group">
                <label for="sell_price_min">Prix de Vente min</label>
                <input type="number" <?php if(isset($_GET) && isset($_GET['sell_price_min']) && $_GET['sell_price_min'] != NULL) {echo('value="'.$_GET['sell_price_min'].'"');}?> step=".01" id="sell_price_min" name="sell_price_min"/>
              </div>
              <div class="form-group">
                <label for="sell_price_max">Prix de Vente max</label>
                <input type="number" <?php if(isset($_GET) && isset($_GET['sell_price_max']) && $_GET['sell_price_max'] != NULL) {echo('value="'.$_GET['sell_price_max'].'"');}?> step=".01" id="sell_price_max" name="sell_price_max"/>
              </div>
            </div>


          </div>



        </div>

        <div class="form-group">
          <label for="description">Description (contient)</label>
          <input type="text" id="description" <?php if(isset($_GET) && isset($_GET['description']) && $_GET['description'] != NULL) {echo('value="'.$_GET['description'].'"');}?> name="description"/>
        </div>

        <div id="bottom-line">
            <div class="link_container">
              <a href="insert.php" class="linkk">Ajouter un produit</a>
            </div>
            <div class="form-group submit">
              <button type="submit" target="_self" >Rechercher</button>
            </div>
            
            <div class="link_container">
              <a href="logout.php" class="linkk">Déconnexion</a>
            </div>
        </div>

        
    
        
    </div>
  </div>

  </form>

</div>

<script src='http://codepen.io/andytran/pen/vLmRVp.js'></script>
<script src="js/index.js"></script>
<script src="js/form.js"></script>
<script src="js/check_search.js"></script>

<script>

  function update_length() {
    let sel_stone = document.getElementById("pierre");
    let length = 20 + document.getElementsByClassName("stone_option")[0].offsetHeight * sel_stone.length;
    sel_stone.style.setProperty('--pierre-hover-height', (length + "px"));
  }

  update_length();

  document.getElementById("buy_price").addEventListener('change', function() {
    document.getElementById("buy_price_min").value = this.value;
    document.getElementById("buy_price_max").value = this.value;
  });

  document.getElementById("sell_price").addEventListener('change', function() {
    document.getElementById("sell_price_min").value = this.value;
    document.getElementById("sell_price_max").value = this.value;
  });

</script>

</body>

</html>
