<?php
include ("includes/head.php"); //head-taggen med alla meta attributen förutom title.

$request = explode("/",substr(@$_SERVER['PATH_INFO'], 1)); //Kollar vad värdet efter / är. Så edit.php/x och $id blir x.

$id = $request[0];

if(isset($request[1])){
    $postid = $request[1];
}
else{
  $postid = null;
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
          include ("includes/no-user.php");
        }
        elseif($postid == null){
          include("includes/user-noposts.php");
        }
        else{
          include("includes/user-posts.php");
        }
      ?>
    </div>
	</div>
</body>
</html>
