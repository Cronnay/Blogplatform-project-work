<?php
$users = getAllUsers("",$db);
//Om det inte anropades någon användare, så kommer det här visas.
?>

<h2>Alla användare</h2>

<table>
  <thead>
    <tr>
      <td>Namn</td>
      <td>Skapad</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach($users as $row){ //en foreach för att visa ta fram alla rader ?> 
    <tr>
      <td><a href="user.php/<?php echo $row['id'];?>" class="tablelink"> <?php echo $row['name']; ?></a> </td>
      <td><?php echo $row['created'] ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
