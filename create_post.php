<?php
include ("includes/head.php"); //head-taggen med alla meta attributen förutom title.
if(isset($_SESSION['loggedin']) == true){ //ifall användaren inte är inloggad skickas användaren tillbaka till framsidan.

	if(isset($_POST['titel'],$_POST['text'])){
		$titel = trim($_POST['titel']); //trimmar texten på onödig whitespace.
		$text = trim($_POST['text']); //trimmar texten på onödig whitespace

		$email = $_SESSION['email'];
		createPost($email,$titel,$text,$db);
	}
	?>

	<title>Skapa ett inlägg</title>
	</head>
	<body>
		<?php include("includes/nav.php"); /* Inkluderar <header> med en navigering för att det ska bli mindre kod.*/ ?>
		<div class='container'>
			<div id='allt'>
				<div id='create-post'>
					<h2 class='header-text'>Skapa ett inlägg här!</h2>
					<div id='create-form'>
						<form method="post" id='add-post'>
							<label for='titel'>Titel</label><br>
							<input type='text' name='titel' id='titel'><br>

							<label for='text'>Ditt inlägg</label><br>
							<textarea name='text' id='text'></textarea><br>
							<input type='submit' value='Skapa ett inlägg!' class='create-btn'>
						</form>
					</div>
				</div>
				<div id='show-posts'>
					<h2 class="header-text">Här är dina senaste fem inlägg</h2>
					<div class='post'>
					<?php
					$result = getUserPosts($_SESSION['email'],$db);
					foreach ($result as $post){ ?>
						<div id='<?php echo $post['id']; ?>'>
							<h3 class='headline-post'><a href='user.php/<?php echo $post["u_id"] . "/" . $post["id"]; ?>'><?php echo $post['title']; ?></a></h3>
							<p class='madeby'>Upplagd <?php echo $post['created']; ?></p>
							<?php
							if(isset($_SESSION['email'])){ //ifall $_session['email'] finns kommer resterande kod funka
								if(correctUser($_SESSION['email'],$post['id'],$db) == true){ //ifall användaren har gjort det inlägget kommer möjligheten att ta bort inlägget och redigera
								?>
									<span class='madeby delete'><a href='#' id='delete-<?php echo $post["id"]; ?>'>Ta bort det här inlägget</a></span>
									<span class='madeby edit'><a href="edit.php/<?php echo $post['id']; ?>">Redigera det här inlägget</a></span>

						<?php
							} // stänger if-satsen för delete och edit knappen
						} //stänger if-isset ?>
						</div>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>
<?php }
else{
	header("location: index.php");
}
