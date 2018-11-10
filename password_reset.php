<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();

$id = $_GET['id'];
$email = $_GET['email'];
$usr = $_GET['usr'];

if (!empty($id) && !empty($usr) && !empty($email)){
	$query = $pdo->prepare("SELECT count(*) FROM users WHERE id=? AND username=? AND email=?");
	$query->execute([$id, $usr, $email]);
	$result = $query->fetch();
	if ($result['count(*)'] == 1){
		$_SESSION['usr'] = $usr;
		$_SESSION['id'] = $id;
		$_SESSION['email'] = $email;
		header("Location: password_front.php");
	}
}

?>