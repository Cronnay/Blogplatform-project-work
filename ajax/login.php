<?php

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GTM");
require("/../includes/functions.php");

$json = $_GET['user']; //Använder GET för att POST inte ville fungera för mig.

$arr = json_decode($json, true); //Decodar json, för att anropa funktionen loginuser

$email = $arr[0]['email'];
$pass = $arr[0]['pass'];

$login = loginUser($email,$pass,$db); //Skickar inloggningsinfo, och returnerar en sträng om den är godkänd eller inte

echo json_encode($login);
?>
