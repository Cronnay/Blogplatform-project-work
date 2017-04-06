<?php
include ("connection.php");

function createUser($email,$namn,$pass,$db){
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

function loginUser($email,$pass,$db){
	$sql = "SELECT * FROM users WHERE email = '$email' AND password = '" . md5($pass) . "'";

	$run = mysqli_query($db,$sql);

	if(mysqli_num_rows($run) > 0)
	{
		$_SESSION['email'] = $email;
		$_SESSION['loggedin'] = true;
		return "ok";
	}
	else
	{
		return "no";
	}
}

function getPosts($db){
	$sql = "SELECT * FROM posts ORDER BY created DESC limit 10";

	$result = mysqli_query($db,$sql) or die("Fel vid sql-fråga");
	$array = array();

	while($row = $result->fetch_assoc())
	{
		$array[] = $row;
	}
	return $array;
}

function getUserPosts($email,$db){
	$sql = "SELECT * FROM posts WHERE email = '$email' ORDER BY created DESC limit 5";

	$result = mysqli_query($db,$sql) or die("Fel vid sql-fråga");
	$array = array();

	while($row = $result->fetch_assoc())
	{
		$array[] = $row;
	}
	return $array;
}
function createPost($email,$titel,$content,$db){
	$getid = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
	$result = mysqli_query($db,$getid);
	$row = mysqli_fetch_assoc($result);

	$id = $row['id'];

	$sql = "INSERT INTO posts (u_id,email,title,content) VALUES ($id,'$email','$titel','$content')";
	if($db->query($sql) == true){
		header("Location: index.php");
	}
}

function correctUser($email,$id,$db){
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

function deletePost($id,$db){
	$sql = "DELETE FROM posts WHERE id = $id";

	$result = mysqli_query($db,$sql) or die("Fel vid sql fråga");
}
?>