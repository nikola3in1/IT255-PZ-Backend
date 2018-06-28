<?php

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'IT255-PZ';

$db_conn = new mysqli($host, $username, $password, $dbname) or
die("Greska prilikom povezivanja sa bazom: " . $db_conn->error);

?>
