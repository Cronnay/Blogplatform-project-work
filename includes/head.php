<?php include("functions.php"); ?>
<html>
<head>
	<meta charset="utf-8" /> <!-- utf8 för att det inte ska bli teckenfel. -->
	<meta name="description" content="Projektarbete om en bloggplattform. Där användare kan skapa och göra sina inlägg." /><!-- En beskrivning på webbsidan. Ifall någon ska söka efter en blogg får dem fram den här sidan -->
	<meta name="author" content="Sebastian Berglönn"> <!-- Vem som är skaparen. -->
	<meta name="keywords" content="Blogg, Projektarbete, MIUN, Sebastian Berglönn, Berglönn" /> <!-- Taggar, så att ifall en användare söker på någon av dem här taggarna kan denna webbplats komma fram. -->
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" href="/web2.0/projekt/css/design.css" /><!-- Länk till min css som är en annan mapp. -->
	<script src="/web2.0/projekt/js/jquery-3.1.1.js"></script>
	<script src="/web2.0/projekt/js/js.js"></script> <!--Både jquery och min javascript blev länkade här. jQuery är nerladdad ifall utvecklaren vill arbeta offline -->
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script> <!-- Ett plugin för validering av e-post och lösenord. Den är inte nerladdad eftersom det var mer filer, och blev enklare att endast göra så här. -->