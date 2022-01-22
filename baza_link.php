<?php

$serwer="localhost";
$nazwa_bazy="us_proj";
$user="root";
$pass="";

$conn = new PDO("mysql:host=$serwer;dbname=$nazwa_bazy", "$user", "$pass");

?>