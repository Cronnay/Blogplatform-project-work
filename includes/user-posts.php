<span class="arrow"><a href="/web2.0/projekt/user.php/<?php echo $id;?>">&laquo;</a></span><!-- HTML-entitet för att indikera att man kan gå tillbaka till användarens inlägg -->
<div id="oneuseronepost">

  <?php
  $post = getOnePost($postid, $db); //En användare, ett inlägg

  foreach($post as $row){ //en foreach för att visa ta fram alla rader ?>
    <h2><?php echo $row['title'];?></h2>
    <p class="brodtext"><?php echo $row['content'];?></p>
    <p class="skapad">Upplagd <?php echo $row['created'];?> av <?php echo $row['email'];?></p>

    <?php } ?>

</div>
