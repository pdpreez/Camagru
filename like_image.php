<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();

if (isset($_SESSION) && !empty($_SESSION['id'])){
	$img_id = $_GET['id'];
	$u_id = $_SESSION['id'];
	$query = $pdo->prepare("SELECT * FROM likes WHERE img_id=? AND u_id=?");
	$query->execute([$img_id, $u_id]);
	$result = $query->fetch();
	if ($result){
		$img_id = $result['img_id'];
		$u_id = $result['u_id'];
		$query = $pdo->prepare("DELETE FROM likes WHERE img_id=? AND u_id=?");
		$query->execute([$img_id, $u_id]);
	}
	else{
		$query = $pdo->prepare("INSERT INTO likes (img_id, u_id, liked) VALUES (?, ?, 1)");
		$query->execute([$img_id, $u_id]);

		$query = $pdo->prepare("SELECT u_id FROM images WHERE id=?");
		$query->execute([$img_id]);
		$result = $query->fetch();
		$query = $pdo->prepare("SELECT * FROM users WHERE id=?");
		$query->execute([$result['u_id']]);
		$result = $query->fetch();

		if ($result['notify'] == 1){

			$link = "http://" . $_SERVER['HTTP_HOST'];
			$link .= str_replace('like_image.php', 'index.php', $_SERVER['SCRIPT_NAME']);
			$to = $result['email'];
			$subject = "Someone liked your image on Camagru!";
			$txt = "Hey there, " . $result['username'];
			$txt .= "!\nGood news! Someone liked your image.\nGo to ";
			$txt .= $link ." to log in and see it.";
			$headers = "From: noreply@camagru.co.za";
			mail($to,$subject,$txt,$headers);
		}
	}

	header("Location: view_image.php?img=$img_id");
}
?>