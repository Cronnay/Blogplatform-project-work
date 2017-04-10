<?php

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GTM");
require("/../includes/functions.php");

$json = $_GET['id'];

$arr = json_decode($json, true);

$id = $arr[0]['id'];

deletePost($id,$db); //Anropar funtionen för att ta bort ett inlägg.

echo json_encode("done");
?>
