<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();

$new_usr = $_POST['username'];
$new_email = $_POST['email'];

if (isset($_POST)){
	$query = $pdo->prepare("SELECT count(id) FROM users WHERE username=? OR email=?");
	$query->execute([$new_usr, $new_email]);
	$result = $query->fetch();
	if ($result['count(id)'] == 0)
	{
		$email = $_SESSION['email'];
		$usr = $_SESSION['usr'];

		$query = $pdo->prepare("SELECT id FROM users WHERE username=? AND email=?");
		$query->execute([$usr, $email]);
		$id = $query->fetch();
		$id = $id['id'];

		if (!empty($_POST['username'])){
			$query = $pdo->prepare("UPDATE users SET username=? WHERE id=$id");
			$query->execute([$new_usr]);
			$_SESSION['usr'] = $new_usr;
		}
		if (!empty($_POST['email'])){
			$query = $pdo->prepare("UPDATE users SET email=? WHERE id=$id");
			$query->execute([$new_email]);
			$_SESSION['email'] = $new_email;
		}
		if (isset($_POST['notify'])){
			$query = $pdo->prepare("UPDATE users SET notify=1 WHERE id=$id");
		}
		else{
			$query = $pdo->prepare("UPDATE users SET notify=0 WHERE id=$id");
		}
		$query->execute();
		header("Location: index.php");
	}
}
?>