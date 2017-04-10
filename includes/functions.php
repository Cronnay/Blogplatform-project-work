<?php
include ("connection.php");

function createUser($email,$namn,$pass,$db){ //Skapar en användare görs via ajax.
	$sql = "INSERT INTO users(email,name,password) VALUES('$email','$namn','" . md5($pass) . "')";

	if($db->query($sql) === TRUE)
	{
		return "ok"; //skickar tillbaka en sträng som ska skickas vidare med ajax.
	}
	else
	{
		return "no";
	}
}

function loginUser($email,$pass,$db){ //Loggar in användaren. görs via ajax
	$sql = "SELECT * FROM users WHERE email = '$email' AND password = '" . md5($pass) . "' LIMIT 1";

	$run = mysqli_query($db,$sql);
	$row = mysqli_fetch_assoc($run);

	$id = $row['id'];
	if(mysqli_num_rows($run) > 0)
	{
		$_SESSION['email'] = $email;
		$_SESSION['loggedin'] = true;
		$_SESSION['id'] = $id;
		return "ok";
	}
	else
	{
		return "no";
	}
}

function getPosts($db){ //På framsidan. Den visar endast 10 inlägg
	$sql = "SELECT * FROM posts ORDER BY created DESC limit 10";

	$result = mysqli_query($db,$sql) or die("Fel vid sql-fråga");
	$array = array();

	while($row = $result->fetch_assoc())
	{
		$array[] = $row;
	}
	return $array; //returnerar en array, och så görs det en foreach
}

function getUserPosts($email,$db){ //När användaren ska göra ett inlägg, visas dem senaste 5 inläggen.
	$sql = "SELECT * FROM posts WHERE email = '$email' ORDER BY created DESC limit 5";

	$result = mysqli_query($db,$sql) or die("Fel vid sql-fråga");
	$array = array();

	while($row = $result->fetch_assoc())
	{
		$array[] = $row;
	}
	return $array;
}

function createPost($email,$titel,$content,$db){ //Skapar ett inlägg.
	$getid = "SELECT id FROM users WHERE email = '$email' LIMIT 1"; //Limit 1 för att simpelt få ur en rad.
	$result = mysqli_query($db,$getid);
	$row = mysqli_fetch_assoc($result);

	$id = $row['id'];

	$sql = "INSERT INTO posts (u_id,email,title,content) VALUES ($id,'$email','$titel','$content')";
	if($db->query($sql) == true){
		header("Location: /web2.0/projekt/user.php/$id");
	}
}

function correctUser($email,$id,$db){ //Kontrollerar ifall användaren har gjort inlägget eller inte. Om det är true, kommer "redigera" och "delete"-knappar upp
	$sql = "SELECT * FROM posts WHERE email = '$email' AND id = $id";

	$run = mysqli_query($db,$sql);

	if(mysqli_num_rows($run) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function deletePost($id,$db){ //tar port en post. Görs via ajax
	$sql = "DELETE FROM posts WHERE id = $id";

	$result = mysqli_query($db,$sql) or die("Fel vid sql fråga");
}

function editPost($user_id, $post_id, $db){ //Ändra post
	$sql = "SELECT *  FROM posts WHERE id = $post_id LIMIT 1";
	$run = mysqli_query($db, $sql);
	$row = mysqli_fetch_assoc($run);

	if($row['u_id'] === $user_id){ //Detta är för att säkerhetsställa att en användare inte kommer åt någon annans användare inlägg.
		return true;
	}
	else{
		return false;
	}
}

function getPost($post_id, $db){ //Tar fram värdena för att redigera ett inlägg
	$sql = "SELECT * FROM posts WHERE id = '$post_id'";

	$result = mysqli_query($db,$sql) or die("Fel vid sql-fråga");
	$array = array();

	while($row = $result->fetch_assoc())
	{
		$array[] = $row;
	}
	return $array;
}

function updatePost($titel, $text, $postid, $db){ //När inlägget har redigerats så skickas det tillbaka, och ändras.
	$sql = "UPDATE posts SET title = '$titel', content = '$text' WHERE id = '$postid'";
	$result = mysqli_query($db, $sql) or die("Fel vid sql-fråga");
}

function getUser($email, $db){ //När användaren vill uppdatera sin profil anropas den här funktionen för att hämta alla data
	$sql = "SELECT * FROM users WHERE email = '$email' ORDER BY created DESC";
	$result = mysqli_query($db, $sql) or die("Fel vid sql-fråga");
	$array = array();

	while($row = $result->fetch_assoc())
	{
		$array[] = $row;
	}
	return $array;
}


function updatePass($email, $pass, $db) { //Om användaren vill byta pass. En jquery validator för att kontrollera allting.
	$hash = md5($pass);
	$sql = "UPDATE users SET password = '$hash' WHERE email = '$email'";

	mysqli_query($db, $sql) or die("fel vid sql-fråga");
}

function updateName($email, $name, $db){ //Om användaren vill byta pass. En jquery validator för att kontrollera allting.
	$cap = ucwords($name); //första den första bokstaven i varje ord
	$sql = "UPDATE users SET name = '$cap' WHERE email = '$email'";

	mysqli_query($db, $sql) or die("fel vid sql-fråga");
}


function getAllUsers($limit, $db){ //Tar fram alla användare. används på framsidan och även när man ska visa alla användare på users.php
	$order ="";
	if($limit !== ""){
		$order = " LIMIT 5"; //På framsidan visas endas 5 användare.
	}

	$sql = "SELECT * FROM users ORDER BY created DESC" . $order; //ifall $order är ifylld så visas endast 5, annars så är $order en tom variabel

	$result = mysqli_query($db, $sql) or die("Fel vid sql-fråga");
	$array = array();

	while($row = $result->fetch_assoc())
	{
		$array[] = $row;
	}
	return $array;
}

function oneUser($id, $db){ //en funktion för att visa alla inlägg av en användare
	$sql = "SELECT * FROM users WHERE id = '$id' ORDER BY created DESC";
	$result = mysqli_query($db, $sql) or die("Fel vid sql-fråga");
	$array = array();

	while($row = $result->fetch_assoc())
	{
		$array[] = $row;
	}
	return $array;
}

function getOnePost($id,$db){ //en funktion för att visa ett specifikt inlägg
	$sql = "SELECT * FROM posts WHERE id ='$id'";
	$result = mysqli_query($db, $sql) or die("Fel vid sql-fråga");
	$array = array();

	while($row = $result->fetch_assoc())
	{
		$array[] = $row;
	}
	return $array;
}
?>
