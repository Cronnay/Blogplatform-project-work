<?php
include ("includes/head.php"); //head-taggen med alla meta attributen förutom title.
if(isset($_SESSION['loggedin']) == true) {
	$request = explode("/",substr(@$_SERVER['PATH_INFO'], 1)); //Kollar vad värdet efter / är. Så edit.php/x och $id blir x.

	$id = $request[0];
	if($id == null){ //ifall X är null, skickar tillbaka till index
		header("Location: index.php");
	}

	if(editPost($_SESSION['id'], $id, $db) == true){
	 ?>

<title>Ändra inlägg</title>
</head>
<body>
	<?php include("includes/nav.php"); /* Inkluderar <header> med en navigering för att det ska bli mindre kod.*/ ?>
	<div class="container">
		<div id='allt'>
			<div id='edit-post'>
				<h2 class='header-text'>Redigera ditt inlägg här</h2>
				<div id='create-form'>
						<?php $result = getPost($id, $db);
						foreach ($result as $row){
							 ?>
	 					<form method="post" id='edit-post' action="user.php/<?php echo $row['u_id'];?>">
						<label for='titel'>Titel</label><br>
						<input type='text' name='titel' id='titel' value="<?php echo $row['title']; ?>"><br>

						<label for='text'>Ditt inlägg</label><br>
						<textarea name='text' id='text'><?php echo $row['content']; ?></textarea><br>
						<input type='submit' value='Redigera inlägget!' class='create-btn'>
						<?php } ?>
					</form>
				</div>
			</div>
	</div>
</div>
</body>
</html>

<?php

			if(isset($_POST['titel'], $_POST['text'])){
				updatePost($_POST['titel'], $_POST['text'], $id, $db); //Uppdaterar inlägget.
			}
	} //Om session['id'] är samma som har gjort inlägget.
	else{
		header("Location: /web2.0/projekt/index.php"); //Ifall session['id'] inte har gjort inlägget skickas användaren till index.
		}
 } // slut på if-satsen
else{
	header("Location: /web2.0/projekt/index.php"); //Ifall användaren inte är inloggad, skickar tillbaka till index.
}

 ?>
