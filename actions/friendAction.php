<?php
include("../includes/connect.php");


	$send = $_SESSION['pseudo'];
	$receive = $_POST['receive'];

	$queryIdSend = $db->prepare("SELECT id FROM `users` WHERE pseudo = ?");
	$queryIdSend->execute([$send]);

	$queryIdReceive = $db->prepare("SELECT id FROM `users` WHERE pseudo = ?");
	$queryIdReceive->execute([$receive]);

	$idSend = $queryIdSend->fetch()['id'];
	$idReceive = $queryIdReceive->fetch()['id'];


// Demande d'ami à soi-même
if($_POST['receive'] == $_SESSION['pseudo']){
		header('location: ../FriendList.php?message=Vous ne pouvez pas être ami avec vous-mêmes :(&type=danger');
		exit;
}


// Champ vide
if(!isset($_POST['receive']) || empty($_POST['receive'])){
		header('location: ../FriendList.php?message=Le champ est vide&type=danger');
		exit;
}


// Relation entre celui qui reçoit et celui qui l'envoie ( 0 étant une relation en attente)
$checkIfRelationExist = $db->prepare('SELECT * FROM relation WHERE receive = ? AND send = ? AND status = ?');
$checkIfRelationExist->execute(array($idReceive, $idSend, 0));

if ($checkIfRelationExist->rowCount() != 0){
	header('location: ../FriendList.php?message=Une demande d\'amitié avec ' . $_POST['receive'] . ' est déjà en cours &type=danger');
	exit;
}


// Relation entre celui qui reçoit et celui qui l'envoie ( 1 étant une relation accepté)
$checkIfRelationExist = $db->prepare('SELECT * FROM relation WHERE receive = ? AND send = ? AND status = ?');
$checkIfRelationExist->execute(array($idReceive, $idSend, 1));

if ($checkIfRelationExist->rowCount() != 0){
	header('location: ../FriendList.php?message=' . $_POST['receive'] . ' est déjà dans votre liste d\'ami &type=danger');
	exit;
}

// Relation entre celui qui envoie et celui qui reçoit ( pour éviter les doublons de relation // send->receive <-> receive->send)
$checkIfRelationExist = $db->prepare('SELECT * FROM relation WHERE receive = ? AND send = ? AND status = ?');
$checkIfRelationExist->execute(array($idSend, $idReceive, 1));

if ($checkIfRelationExist->rowCount() != 0){
	header('location: ../FriendList.php?message=' . $_POST['receive'] . ' vous à déjà envoyés une demande&type=danger');
	exit;
}
	$relation = $db->prepare("INSERT INTO `relation` (`send`,`receive`, `status`) VALUES (?,?,?)");
	$relation->execute(array($idSend, $idReceive, 0));

//Demande d'ami envoyé avec succès
	header('location: ../FriendList.php?message=' . $_POST['receive'] . ' est maintenant votre ami&type=success');
	exit;
