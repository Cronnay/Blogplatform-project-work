<?php

$database = "dt091g";
$server = "localhost";
$user = "root";
$pass = "";

$db = mysqli_connect($server,$user,$pass,$database) or die("Fel vid anslutning");

session_start();
?>