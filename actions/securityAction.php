<?php
session_start();
if(!isset($_SESSION['authentified'])){
    header('Location:login.php');
}
?>