<?php 
include ("includes/head.php"); //head-taggen med alla meta attributen förutom title.
if(isset($_SESSION['loggedin']) == true){
	$request = explode("/",substr(@$_SERVER['PATH_INFO'], 1)); ?>

	<title>Ändra inlägg</title>
</head>
<body>
	<?php include("includes/nav.php"); /* Inkluderar <header> med en navigering för att det ska bli mindre kod.*/ ?>
	<div class="container">

	</div>
</body>
</html>

<?php }

else{
	header("Location: index.php");

} ?>