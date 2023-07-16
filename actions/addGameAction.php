<?php 

if(empty($_POST['game_name']) || empty($_POST['game_name'])){
	header('location: ../addGame.php?message=Veuillez mettre le nom du jeu.&type=danger');
	exit;
}
include('../includes/db.php');

$q = 'SELECT game_name FROM games WHERE game_name = ?';
$req = $db->prepare($q);
$req->execute([$_POST['game_name']]);

$ifGameExist = $req->fetchAll();

if(count($ifGameExist) != 0){
	header('location: ../addGame.php?message=Ce jeu existe déjà.&type=danger');
	exit;
}



if($_FILES['game_image']['error'] != 4){

	$acceptable = [
					'image/jpeg',
					'image/png',
					'image/gif',
					'image/jpg'
		];

	if(!in_array($_FILES['game_image']['type'], $acceptable)){
		header('location: ../addGame.php?message=Type de fichier invalide.&type=danger');
		exit;
	}			


	$maxSize = 2 * 1024 * 1024; // 2Mo

	if($_FILES['game_image']['size'] > $maxSize){
		header('location: ../addGame.php?message=L\'image est trop lourde pour notre bdd :( , vérifier qu\'elle ne dépasse pas 2 Mo&type=danger');
		exit;
	}

	$filename = $_FILES['game_image']['name'];
	$array = explode('.', $filename);
	$ext = end($array);
	$filename = 'image-' . time() . '.' . $ext;
	$path = 'uploads/game_image';

	$destination = $path . '/' . $filename;

	move_uploaded_file($_FILES['game_image']['tmp_name'], $destination);

}

$q = 'INSERT INTO games (game_name, game_type, game_image, game_description) VALUES (:game_name, :game_type, :game_image, :game_description)';
$req = $db->prepare($q);
$result = $req->execute([
			'game_name' => $_POST['game_name'],
			'game_type' => $_POST['game_type'],
			'game_image' => isset($filename) ? $filename : '', 
			'game_description' => $_POST['game_description']
		]);


if($result){
	header('location: ../addGame.php?message=Le jeu a bien été ajouté au catalogue !&type=success');
	exit;
}
else{
	header('location: ../addGame.php?message=Erreur lors de l\'ajout du jeu&type=danger');
	exit;
}

?>






