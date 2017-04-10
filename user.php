<?php
include ("includes/head.php"); //head-taggen med alla meta attributen förutom title.

$request = explode("/",substr(@$_SERVER['PATH_INFO'], 1)); //Kollar vad värdet efter / är. Så edit.php/x och $id blir x.

$id = $request[0]; //det är värdet efter '/'. t.ex user.php/3 så är $id = 3

if(isset($request[1])){ //Om det finns ett till snedstreck, så kollar den inte vilket värde.
    $postid = $request[1];
}
else{
  $postid = null; //För att endast ha en $postid, och för att enkelt kunna inkludera rätt fil
}

?>
<title>Användare</title>
</head>
<body>
	<?php include("includes/nav.php"); /* Inkluderar <header> med en navigering för att det ska bli mindre kod.*/ ?>
	<div class='container'> <!-- all info ska vara inne här -->
    <div id="users">
      <?php
        if($id == null){
          include ("includes/no-user.php"); //Om inget post-id eller användar-id har angetts, så inkluderar no-user.php
        }
        elseif($postid == null){
          include("includes/user-noposts.php"); //Om inget post-id men ett användar-id har angetts, så inkluderar user-noposts.php
        }
        else{
          include("includes/user-posts.php"); //Om båda är angivna, så inkluderar user-posts.php
        }
      ?>
    </div>
	</div>
</body>
</html>
