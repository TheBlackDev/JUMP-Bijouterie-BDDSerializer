<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>

      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  
<!-- Form-->
<div class="form">
  <div class="form-toggle"></div>
  <div class="form-panel one">
    <div class="form-header">
      <h1>Identification</h1>
    </div>
    <div class="form-content">
      <form method="post">
        <div class="form-group">
          <label for="username">Nom d'utilisateur</label>
          <input type="text" id="username" name="username" required="required"/>
        </div>
        <div class="form-group">
          <label for="password">Mot de passe</label>
          <input type="password" id="password" name="password" required="required"/>
        </div>
        <div class="form-group">
          <button type="submit">S'identifier</button>
        </div>
      </form>
    </div>
  </div>
</div>


  <script src='http://codepen.io/andytran/pen/vLmRVp.js'></script>
  <script src="js/index.js"></script>

</body>
</html>
