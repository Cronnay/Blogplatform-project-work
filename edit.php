<?php
include ("includes/head.php"); //head-taggen med alla meta attributen förutom title.
if(isset($_SESSION['loggedin']) == true) {
	 ?>

<title>Ändra inlägg</title>
</head>
<body>
	<?php include("includes/nav.php"); /* Inkluderar <header> med en navigering för att det ska bli mindre kod.*/ ?>
	<div class="container">
		<div id='allt'>
			<div id='create-post'>
				<h2 class='header-text'>Redigera ditt inlägg här</h2>
				<div id='create-form'>
					<form method="post" id='edit-post'>
						<?php $result = getPost($_POST['editpost'], $db);
						foreach ($result as $row){
							 ?>
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
</body>
</html>

<?php
 } // slut på if-satsen
else{
		header("Location: index.php");
	}

 ?>
