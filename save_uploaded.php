<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();

if (isset($_SESSION) && !empty($_SESSION['id'])){
	$img_dir = "./images/";
	$img_name = basename($_FILES['file']['name']);
	$new_name = uniqid();
	$img_file_type = "." . strtolower(pathinfo($img_dir . $_FILES['file']['name'], PATHINFO_EXTENSION));
	$target = $img_dir . $new_name . $img_file_type;
	move_uploaded_file($_FILES['file']['tmp_name'], $target);

	$query = $pdo->prepare("INSERT INTO images (u_id, img_name) VALUES (?, ?)");
	$query->execute([$_SESSION['id'], $target]);

	$stmt = $pdo->prepare("SELECT * FROM images WHERE img_name=?");
	$stmt->execute([$target]);
	$result = $stmt->fetch();

	header("Location: index.php");
}

?>