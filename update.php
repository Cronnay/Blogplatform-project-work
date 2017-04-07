<?php
include ("includes/head.php"); //head-taggen med alla meta attributen förutom title.
if(isset($_SESSION['loggedin']) == true) { ?>
<title>Uppdatera din profil</title>
</head>
<body>
	<?php include("includes/nav.php"); /* Inkluderar <header> med en navigering för att det ska bli mindre kod.*/ ?>
	<div class="container">
		<div id='create-account'>
			<div id="mindre"> <!-- en div för bredden mindre för att errortexten skulle hamna under -->
				<h2>Uppdatera ditt konto</h2>
				<?php $result = getUser($_SESSION['email'], $db);
				foreach($result as $row){ ?>

					<h3><?php echo $row['email']; ?></h3><br>
					<form method="post" id="byta-namn" autocomplete="off">

						<label for="namn" class="center">Vill du byta namn?</label><br>
						<input type="text" id="namn" class="center" name="namn" value="<?php echo $row['name']; ?>"><br>
						<input type="submit" class="btn" value="Byt namn">

					</form>
					<form method="post" id="byta-pass" autocomplete="off">

						<label for="pass" class="center">Vill du byta lösenord?</label><br>
						<input type="password" id="password" class="center" name="password"><br>

						<label for="pass_again" class="center">Upprepa lösenord</label><br>
						<input type="password" id="pass_again" class="center" name="pass_again"><br>
						<input type="submit" class="btn" value="Byt lösenord">

					</form>
			<?php	} ?>
			</div>
		</div>
	</div>
</body>
</html>
<?php
		if(isset($_POST['password'], $_POST['pass_again'])){  //detta händer ifall användaren byter lösenord.
			$pass = $_POST['password'];

			updatePass($_SESSION['email'], $pass, $db);
			header("Location: update.php");
		}
		if(isset($_POST['namn'])){
			$namn = $_POST['namn'];

			updateName($_SESSION['email'], $namn, $db);
			header("Location: update.php");
		}
} //Stänger if-satsen ifall användaren är inloggad.
else{
	header("Location: /web2.0/projekt/index.php"); //Ifall användaren inte är inloggad, skickar tillbaka till index.
}

 ?>
