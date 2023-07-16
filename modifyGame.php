<?php
include('includes/connect.php');
include ('includes/navHome.php');
?>

<!DOCTYPE html>
<?php include('includes/header.php');?>
<body class="container-fluid">

<script src="assets/bootstrap/js/bootstrap.js"></script>

<section class="login-dark-2">


<?php


$lastkey = array_key_last($_POST);
$i = explode("-", $lastkey);

$f = $i[0];
$i = $i[1];

$game_type = $_POST['game_type-'.$i];
$game_name = $_POST['game_name-'.$i];
$game_image = $_POST['game_image-'.$i];
$game_description = $_POST['game_description-'.$i];

$game_id = $i;

echo '<form enctype="multipart/form-data" action="actions/modifyGameAction.php?id=' . $game_id . '" method="POST">';
include("includes/message.php");

// Supprimez un jeu
if( $f == 'delete'){
    echo'
        <div class="mb-3">
        <label class="input-group-text">Etes-vous sûr de vouloir supprimer '. $game_name . '?</label>
            <input type="text" name="game_delete" class="form-control" placeholder="Ecrivez le nom du jeu pour le supprimer">
            <input type="text" name="game_name" class="visually-hidden" value="'.$game_name.'">
        <div class="mb-3">
    ';
}

if ( $f == 'modifyName'){

//Nom du jeu
echo '<div class="mb-3">
  <input type="text" name="game_name" class="form-control" value="' . $game_name . '">
</div>';

}elseif ( $f == 'modifyType') {
  


//Type de jeu
echo '<div class="input-group mb-3">
  <select name="game_type" class="form-select" id="inputGroupSelect02">
    <option selected>' . $game_type . '</option>
    <option value="FPS">FPS</option>
    <option value="MOBA">MOBA</option>
    <option value="MMORPG">MMORPG</option>
    <option value="RPG">RPG</option>
    <option value="Aventure">Aventure</option>
    <option value="Plateforme">Plateforme</option>
  </select>
  <label class="input-group-text" for="game_type">Type de jeu</label>
</div>';

}elseif ( $f == 'modifyImage') {
  



//Upload image
echo '<div class="input-group mb-3">

  <input type="file" name="game_image" class="form-control" accept="image/jpeg, image/png, image/pnj, image/gif">  
  <label class="input-group-text" for="game_image">Image du jeu</label>
</div>';  
}elseif ( $f == 'modifyDescription') {
  

//Description du jeu
echo'<div class="mb-3">
  <label for="game_description" class="form-label"></label>
  <textarea name="game_description" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="' . $game_description . '"></textarea>
</div>';
}

//Submit button
echo'

<div class="mb-3">';

if($f == 'delete'){
    echo '<button name="delete-' . $i . '" class="btn btn-danger" type="submit">Supprimer le jeu</button>';
}else{
    echo '<button name="modify-' . $i . '" class="btn btn-primary" type="submit">Modifier le jeu</button>';
}

echo '</div>';
?>



</form>


</section>
</body>
</html>
