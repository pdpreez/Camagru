<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();

if (isset($_SESSION) && !empty($_SESSION['id'])){
	$img_id = $_GET['id'];
	$u_id = $_SESSION['id'];
	$query = $pdo->prepare("SELECT * FROM likes WHERE id=? AND u_id=?");
	$query->execute([$img_id, $u_id]);
	$result = $query->fetch();
	if ($result){
		$img_id = $result['id'];
		$u_id = $result['u_id'];
		if ($result['liked'] == true){
			$query = $pdo->prepare("UPDATE likes SET liked=0 WHERE id=$img_id AND u_id=$u_id");
		}
		else{
			$query = $pdo->prepare("UPDATE likes SET liked=1 WHERE id=$img_id AND u_id=$u_id");
		}
		$query->execute();
	}
	else{
		$query = $pdo->prepare("INSERT INTO likes (id, u_id, liked) VALUES (?, ?, 1)");
		$query->execute([$img_id, $u_id]);
	}
	header("Location: view_image.php?img=$img_id");
}
?>