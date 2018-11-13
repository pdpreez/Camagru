<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();

if (isset($_SESSION) && !empty($_SESSION['id'])){
	$id = $_GET['id'];
	$u_id = $_SESSION['id'];
	$query = $pdo->prepare("SELECT * FROM images WHERE id=?");
	$query->execute([$id]);
	$result = $query->fetch();
	$img_name = $result['img_name'];

	$query = $pdo->prepare("DELETE FROM images WHERE id=?");
	$query->execute([$id]);
	$query = $pdo->prepare("DELETE FROM likes WHERE img_id=?");
	$query->execute([$id]);
	$query = $pdo->prepare("DELETE FROM comments WHERE img_id=?");
	$query->execute([$id]);
	if ($img_name)
		unlink($img_name);
	header("Location: index.php");
}
?>