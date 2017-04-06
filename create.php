<?php 
include ("includes/head.php"); //head-taggen med alla meta attributen förutom title.
if(isset($_SESSION['loggedin']) == true){
	header("Location: index.php");
}
else{

?>
<title>Skapa ett konto!</title>
</head>
<body>
	<?php include("includes/nav.php"); /* Inkluderar <header> med en navigering för att det ska bli mindre kod.*/ ?>
	<div class="container">
		<div id='create-account'>
			<h2>Skapa ett konto!</h2>
			<form id="skapa-konto" method="post" class="center"> <!-- formuläret för att skapa konto. Den kräver e-mail, namn, lösenord. Detta kommer sedan valideras av ett jquery plugin. -->
				<label for="email" class="center">E-mail</label><br>
				<input type="text" id="email" class="center" name="email"><br>

				<label for="name" class="center">Namn</label><br>
				<input type="text" id="namn" class="center" name="namn"><br>

				<label for="pass" class="center">Lösenord</label><br>
				<input type="password" id="password" class="center" name="password"><br>

				<label for="pass_again" class="center">Upprepa lösenord</label><br>
				<input type="password" id="pass_again" class="center" name="pass_again"><br>
				<input type="submit" class="btn" value="Skapa ett konto!">
			</form>
		</div>
	</div>
</body>
</html>
<?php } ?>