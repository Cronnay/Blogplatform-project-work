<header>
	<nav>
	<?php if(isset($_SESSION['loggedin']) == true){ //om användaren är inloggad så syns en liknande nav. Enklare att kolla än att behöva skriva php mitt i koden.
		?>
		<ul class="big"><!--Mer knappar, därav en annan design -->
			<li class="inline"><a href="/web2.0/projekt/index.php">Framsidan</a></li>
			<li class="inline"><a href="/web2.0/projekt/create_post.php">Skapa ett inlägg</a></li>
			<li class="inline"><a href="/web2.0/projekt/update.php">Uppdatera din profil</a></li>
			<li class="inline"><a href="/web2.0/projekt/logout.php">Logga ut</a></li>
		</ul>
	<?php }
	else{
		?>
		<ul class='small'> <!--Färre knappar, därav en annan design -->
			<li class="inline"><a href="/web2.0/projekt/index.php">Framsidan</a></li>
			<li class="inline"><a href="/web2.0/projekt/create.php">Skapa ett konto</a></li>
		</ul>
	<?php } ?>
	</nav>
</header>
