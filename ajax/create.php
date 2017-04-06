<?php

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GTM");
require("/../includes/functions.php");

$json = $_GET['user'];

$arr = json_decode($json, true); 

$email = $arr[0]['email'];
$name = $arr[0]['namn'];
$pass = $arr[0]['pass'];

$konto = createUser($email,$name,$pass,$db);



echo json_encode($konto);
?>