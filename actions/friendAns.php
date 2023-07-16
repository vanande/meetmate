<?php
include("../includes/connect.php");


$lastkey = array_key_last($_POST);
$i = explode("-", $lastkey);

$f = $i[0];
$i = $i[1];

$send = $_POST['send-' .$i] ;
$receive = $_POST['receive-'.$i];

$idSend = $_POST['idSend-' . $i];
$idReceive = $_POST['idReceive-'.$i];

function accept($idSend, $idReceive)
{
    include('../includes/db.php');
    $q = $db->prepare("UPDATE relation SET status = ? WHERE send = ? AND receive = ?");
    $q->execute([1, $idSend, $idReceive]);
}

function refuse($idSend, $idReceive)
{
    include('../includes/db.php');

    $q = $db->prepare("DELETE FROM relation WHERE send = ? AND receive = ? ");
    $q->execute([$idSend, $idReceive]);
}

function delete($idSend, $idReceive)
{
    include('../includes/db.php');
    $q = $db->prepare("DELETE FROM relation WHERE send = ? AND receive = ? ");
    $q->execute([$idSend, $idReceive]);

}


if($f == 'accept') {
    accept($idSend, $idReceive);
    header('location: ../FriendList.php?message= ' . $send . ' est désormais votre ami&type=success');
    exit();
}
else if($f == 'refuse') {
    refuse($idSend, $idReceive);
    header('location: ../FriendList.php?message=Vous avez refusé la demande d\'ami de  ' . $send . ' &type=warning');
    exit();
}
else if ($f == 'delete') {
    delete($idSend, $idReceive);
    header('location: ../FriendList.php?message= ' . $send . ' n\'est plus votre ami&type=warning');
    exit();
}


