<?php
include("../includes/connect.php");

$lastkey = array_key_last($_POST);
$i = explode("-", $lastkey);

$f = $i[0];
$i = $i[1];

$user = $_POST['user-' .$i];
$idUser = $_POST['idUser-' .$i];


function promote($idUser)
{
    include('../includes/db.php');
    $q = $db->prepare("UPDATE users SET roles = ? WHERE id = ?");
    $q->execute([1, $idUser]);
}

function demote($idUser)
{
    include('../includes/db.php');

    $q = $db->prepare("UPDATE users SET roles = ? WHERE id = ?");
    $q->execute([0, $idUser]);
    
}

function delete($idUser)
{
    include('../includes/db.php');

    // Delete user references in relation
    $q = $db->prepare("DELETE FROM relation WHERE receive = ? OR send = ?");
    $q->execute([$idUser]);

    $q = $db->prepare("DELETE FROM users WHERE id = ?");
    $q->execute([$idUser]);

}

if($f == 'promote') {
    promote($idUser);
    header('location: ../admin.php?message= ' . $user . ' est promu au rang admin&type=success');
    exit();
}
else if($f == 'demote') {
    demote($idUser);
    header('location: ../admin.php?message= ' . $user . ' s\'est fait rétrograder&type=warning');
    exit();
}
else if ($f == 'delete') {
    delete($idUser);
    header('location: ../admin.php?message= ' . $user . ' a été supprimer&type=danger');
    exit();
}


