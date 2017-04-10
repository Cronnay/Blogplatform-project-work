<?php
include ("includes/head.php"); //head-taggen med alla meta attributen förutom title.
?>
<title>Framsidan</title>
</head>
<body>
	<?php include("includes/nav.php"); /* Inkluderar <header> med en navigering för att det ska bli mindre kod.*/ ?>
	<div class='container'> <!-- all info ska vara inne här -->
		<div id="posts"> <!--Den vänstra diven, för att få dit alla posts. -->
			<div class='post'> <!-- mindre div, och blir centrerad  i posts-diven -->
				<?php
					$result = getPosts($db); //Returnerar en array med alla inlägg
					foreach ($result as $post){
						$readmore = strip_tags($post['content']); // min funktion för att rensa. Tack vare Webbiedave på Stackoverflow som skrev denna kod för att förkorta texten.
						if(strlen($readmore) > 400){
							$stringCut = substr($readmore, 0, 400);

							$readmore = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="/web2.0/projekt/user.php/' . $post['u_id'] . '/' . $post['id'] . '">Läs mer</a>';
						}
						?>
					<div id='<?php echo $post["id"]; ?>'> <!-- div med unik id för att lättare hantera med jquery -->
							<h3 class='headline-post'><?php echo $post['title']; ?></h3>
							<p class='content'><?php echo $readmore; ?></p>
							<p class='madeby'>Gjordes av <a href='user.php/<?php echo $post["u_id"]; ?>'><?php echo $post['email'] . "</a>, " . $post['created']; ?></p>
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
					<?php }
				?>
			</div>
		</div>
		<div id="login">
			<?php if(isset($_SESSION['loggedin']) == true){ // ifall användaren är inloggad så tar den bort inloggningsformuläret
				?>
					<h3 class="center plats-under">Välkommen!</h3>
					<p><?php echo $_SESSION['email']; ?> </p>
			<?php } //Slut på if-isset. Så om Användaren inte är inloggad, så kommer det finnas möjlighet att logga in.
			else{ ?>
				<h3 class="center plats-under">Logga in här!</h3>
				<form method="post" id='login-form' class="center">
					<label for="email" class="center">E-mail</label><br>
					<input type="text" id="email" class="center" name="email"><br>

					<label for="pass" class="center">Lösenord</label><br>
					<input type="password" id="password" class="center" name="password"><br>
					<input type="submit" class="btn" value="Logga in!">
				</form>
				<h3 class="center plats-under"><a href='create.php'>Skapa ett konto här</a></h3>
				<p class="error-msg"></p>
			<?php }  // stänger else ?>
		</div>
		<div id="user-login"> <!--Div som håller alla användare under inloggningen -->
			<h4 class="center">De 5 senaste registrerade användarna</h4>
			<ul id="users-ul">
				<?php
				$result = getAllUsers(5, $db); //Alla användare, som har en maxgräns på 5 stycken användare.

				foreach($result as $row){ ?>
					<li><a href="user.php/<?php echo $row['id'];?>" class="tablelink"><?php echo $row['name'];?></a></li>
				<?php } ?>
			</ul>
			<a href="user.php" class="tablelink">Klicka här för att visa alla användare</a>
		</div>
	</div>
</body>
</html>
