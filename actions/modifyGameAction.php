<?php
include('../includes/db.php');

$lastkey = array_key_last($_POST);
$i = explode("-", $lastkey);

$f = $i[0];
$i = $i[1];


if(isset($_POST['game_delete']) && $_POST['game_delete'] == $_POST['game_name']){
	deleteGame($i);
}else if(isset($_POST['game_delete']) && $_POST['game_delete'] != $_POST['game_name']){
	header('location: ../game.php?message=La suppression du jeu a été correctement annulé.&type=danger');
}else if(isset($_POST['game_type'])){
	$game_type = $_POST['game_type'];
	modifyGameType($i, $game_type);

} else if(isset($_POST['game_name']) && !empty($_POST['game_name'])){
	$game_name = $_POST['game_name'];
}else if(isset($_FILES) && !empty($_FILES['game_image']['name'])){
	$game_image = $_FILES['game_image'];
}else if(isset($_POST['game_description']) && !empty($_POST['game_description'])){
	$game_description = $_POST['game_description'];
}else{
	header('location: ../game.php?message=Parametres manquants.&type=danger');
	exit;
}


if (isset($game_name)) {
// Vérifier que le nom du jeu n'est pas déjà utilisé
	$q = 'SELECT game_name FROM games WHERE game_name = ?';
	$req = $db->prepare($q);
	$req->execute([$game_image['game_name']]);

	$ifGameExist = $req->fetchAll(); // Récupérer tous les résultats et les mettre dans un tableau

	if (count($ifGameExist) != 0) {
		header('location: ../game.php?message=Ce jeu existe déjà.&type=danger');
		exit;
	}
	modifyGameName($i, $game_name);
}


if(isset($game_image)) {
	if ($game_image['error'] != 4) {

		$acceptable = [
			'image/jpeg',
			'image/png',
			'image/gif',
			'image/jpg'
		];

		if (!in_array($_FILES['game_image']['type'], $acceptable)) {
			header('location: ../game.php?message=Type de fichier invalide.&type=danger');
			exit;
		}


		$maxSize = 2 * 1024 * 1024; // 2Mo

		if ($_FILES['game_image']['size'] > $maxSize) {
			header('location: ../game.php?message=L\'image est trop grosse pour notre bdd :( , vérifier qu\'elle ne dépasse pas 2 Mo&type=danger');
			exit;
		}

		// Enregistrement du fichier sur le serveur
		$filename = $game_image['name'];
		$array = explode('.', $filename);
		$ext = end($array);
		$filename = 'image-' . time() . '.' . $ext;
		$path = 'uploads/game_image';
		if(!file_exists($path)){
			mkdir($path, 0777);
		}
		$destination = $path . '/' . $filename;

		move_uploaded_file($_FILES['game_image']['tmp_name'], $destination);
	}
	modifyGameImage($i, $filename);
}

if(isset($game_description)){
	modifyGameDescription($i, htmlspecialchars($game_description));
}

function modifyGameName($game_id, $game_name){
	include('../includes/db.php');
	$q = $db->prepare('UPDATE games SET game_name = ? WHERE game_id = ? ');
	$res = $q->execute([$game_name, $game_id]); // ++ car le game_id commence à 1 et l'indice à 0
	if($res){
		header('location: ../game.php?message=Les modifications sont validés&type=success');
	}else{
		header('location: ../game.php?message=Les modifications ont échoués&type=warning');
	}
}

function modifyGameType($game_id, $game_type){
	include('../includes/db.php');
	$q = $db->prepare('UPDATE games SET game_type = ? WHERE game_id = ? ');
	$res = $q->execute([$game_type, $game_id]);
	if($res){
	header('location: ../game.php?message=Les modifications sont validés&type=success');
	}else{
		header('location: ../game.php?message=Les modifications ont échoués&type=warning');
	}
}

function modifyGameImage($game_id, $game_image){
	include('../includes/db.php');
	$q = $db->prepare('UPDATE games SET game_image = ? WHERE game_id = ? ');
	$res = $q->execute([$game_image, $game_id]);
	if($res){
	header('location: ../game.php?message=Les modifications sont validés&type=success');
	}else{
		header('location: ../game.php?message=Les modifications ont échoués&type=warning');
	}
}

function modifyGameDescription($game_id, $game_description){
	include('../includes/db.php');
	$q = $db->prepare('UPDATE games SET game_description = ? WHERE game_id = ? ');
	$res = $q->execute([$game_description, $game_id]);
	if($res){
	header('location: ../game.php?message=Les modifications sont validés&type=success');
}else{
	header('location: ../game.php?message=Les modifications ont échoués&type=warning');
}
}

function deleteGame($game_id){
	include('../includes/db.php');
	$q = $db->prepare('DELETE FROM games WHERE game_id = ? ');
	$res = $q->execute([$game_id]);
	if($res){
		header('location: ../game.php?message=Le jeu a été supprimer&type=success');
	}else{
		header('location: ../game.php?message=Les modifications ont échoués&type=warning');
	}
}


?>






