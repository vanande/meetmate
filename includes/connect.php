<?php 
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','meetmate');


$dsn = 'mysql:host=localhost:3308;dbname=meetmate;charset=utf8';

try {
    session_start();
    $db = new PDO($dsn, DBUSER, DBPASS);
}catch(PDOException $exception){
    die("erreur" . $exception->getMessage());
}
?>
