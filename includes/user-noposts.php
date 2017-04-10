<span class="arrow"><a href="/web2.0/projekt/user.php">&laquo;</a></span><!-- HTML-entitet för att indikera att man kan gå tillbaka till användarens inlägg -->
<?php
$users = oneUser($id,$db);
$email =""; //deklarerad innan loopen, annars kommer den endast finnas i loopen.

foreach($users as $row){ //Behöver foreach för att få ut namnet ?>
<h2><?php echo $row['name']; ?>s senaste inlägg</h2>

<?php
$email = $row['email']; //För att simpelt kunna använda i funktionen nedan
}

$posts = getUserPosts($email, $db); //skriva ut postsen som användaren har gjort
if(empty($posts)){ //Om den returnerar en tom array, så skriver vi ut ett meddelande istället
  echo "<h4 class='noposts'>Den här användaren har inte gjort några inlägg än</h4>";
}
else{
  echo "<ul class='userposts'>";
    foreach($posts as $row){ ?>

        <li>
          <a href="/web2.0/projekt/user.php/<?php echo $row['u_id'] . '/' . $row['id']; ?>" class="tablelink"><?php echo $row['title']; ?></a>
        </li>

<?php
    } // slut på foreach
  echo "</ul>";
} // slut på if-satsen
?>
