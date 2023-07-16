<?php 

$dsn = 'mysql:host=localhost;dbname=meetmate;charset=utf8';
$con = mysqli_connect("localhost","root","","meetmate");

if (!$con) {
    echo "Database erro".mysqli_error($con);
}

?>