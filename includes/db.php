<?php
$dsn = 'mysql:host=localhost:3308;dbname=meetmate;charset=utf8';
						try {
							$db = new PDO($dsn, 'root', '');
						}catch(PDOException $exception){
							die("erreur" . $exception->getMessage());
						}
?>