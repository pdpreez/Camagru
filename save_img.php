<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();

$image = explode(',', $_POST['input']);

if (isset($_SESSION) && !empty($_SESSION['id'])){

	$img_dir = "./images/";
	$name = uniqid() . ".png";
	$img = base64_decode($image[1]);
	file_put_contents($img_dir . $name, $img);	
	
	$query = $pdo->prepare("INSERT INTO images (u_id, img_name) VALUES (?, ?)");
	$query->execute([$_SESSION['id'], $img_dir.$name]);

	$stmt = $pdo->prepare("SELECT * FROM images WHERE img_name=?");
	$stmt->execute([$img_dir.$name]);
	$result = $stmt->fetch();
	$img_id = $result['id'];

	header("Location: edit_image_front.php?id=$img_id");
}
?>