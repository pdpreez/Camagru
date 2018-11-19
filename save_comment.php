<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();

if (isset($_SESSION) && !empty($_SESSION['id'])){
	$u_id = $_SESSION['id'];
	$comment = htmlentities($_GET['comment']);
	echo $comment;
	$img_id =  $_GET['id'];
	
	$query = $pdo->prepare("INSERT INTO comments (img_id, u_id, comments) VALUES (?, ?, ?)");
	$query->execute([$img_id, $u_id, $comment]);

	$query = $pdo->prepare("SELECT u_id FROM images WHERE id=?");
	$query->execute([$img_id]);
	$result = $query->fetch();
	$query = $pdo->prepare("SELECT * FROM users WHERE id=?");
	$query->execute([$result['u_id']]);
	$result = $query->fetch();

	if ($result['notify'] == 1){
		$link = "http://" . $_SERVER['HTTP_HOST'];
		$link .= str_replace('save_comment', 'index', $_SERVER['SCRIPT_NAME']);
		$to = $result['email'];
		$subject = "Someone commented on your image on Camagru!";
		$txt = "Hey there, " . $result['username'];
		$txt .= "!\nGood news! Someone commented on your image.\nGo to ";
		$txt .= $link . " to log in and see the comment.";
		$headers = "From: noreply@camagru.co.za";
		mail($to,$subject,$txt,$headers);
	}

	header("Location: view_image.php?img=$img_id");
}
?>