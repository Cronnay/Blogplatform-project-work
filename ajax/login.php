<?php

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GTM");
require("/../includes/functions.php");

$json = $_GET['user'];

$arr = json_decode($json, true); 

$email = $arr[0]['email'];
$pass = $arr[0]['pass'];

$login = loginUser($email,$pass,$db);

echo json_encode($login);
?>