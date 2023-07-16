<?php
include('includes/connect.php');
include ('includes/navHome.php');
?>

<!DOCTYPE html>
<?php include('includes/header.php');?>
<body class="container-fluid">

<script src="assets/bootstrap/js/bootstrap.js"></script>

<section class="login-dark-2">


<form enctype="multipart/form-data" action="actions/addGameAction.php" method="POST">
<?php include("includes/message.php") ?>

<!-- Nom du jeu -->
<div class="mb-3">
  <input type="text" name="game_name" class="form-control" placeholder="League of Legends...">

</div>

<!-- Type de jeu -->
<div class="input-group mb-3">
  <select name="game_type" class="form-select" id="inputGroupSelect02">
    <option selected>Choix du type...</option>
    <option value="FPS">FPS</option>
    <option value="MOBA">MOBA</option>
    <option value="MMORPG">MMORPG</option>
    <option value="RPG">RPG</option>
    <option value="Aventure">Aventure</option>
    <option value="Plateforme">Plateforme</option>
  </select>
  <label class="input-group-text" for="game_type">Type de jeu</label>
</div>


<!-- Upload image -->
<div class="input-group mb-3">
  <input type="file" name="game_image" class="form-control" accept="image/jpeg, image/jpg, image/png, image/pnj, image/gif">
  <label class="input-group-text" for="game_image">Image du jeu</label>
</div>  

<!-- Description du jeu -->
<div class="mb-3">
  <label for="game_description" class="form-label"></label>
  <textarea name="game_description" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description du jeu..."></textarea>
</div>    

<!-- Submit button -->

<div class="mb-3">
    <button class="btn btn-primary" type="submit">Ajouter le jeu</button>
  </div>

</form>


</section>
</body>
</html>
