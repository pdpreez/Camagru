<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();

$email = $_POST['email'];

$to = "ppreez@student.wethinkcode.co.za";
$subject = "Password reset";
$text = "Please click the following link to reset your password: \n";
$headers = "From: noreply@camagru.com";

if (!empty($email))
{
	$query = $pdo->prepare("SELECT count(id), id, username FROM users WHERE email=?");
	$query->execute([$email]);
	$addr = $query->fetch();
	if ($addr['count(id)'] == 1){
		$id = $addr['id'];
		$usr = $addr['username'];
		$text .= "http://localhost:8080/Web/Camagru/password_reset.php?id=$id&usr=$usr&email=$email";
		mail($to,$subject,$text,$headers);
		header("Location: index.php");
	}
}

?>