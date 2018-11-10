<?php

require_once("header.php");
require_once("./config/database.php");
require_once("./config/connect.php");


if ((isset($_GET) && !empty($_GET['usr'])) && !empty($_GET['email']))
{	
	$usr = $_GET['usr'];
	$email = $_GET['email'];
	try{
		$query = $pdo->prepare("SELECT id FROM users WHERE username=? AND email=?");
		$query->execute([$usr, $email]);
		$id = $query->fetch();
		$id = $id['id'];
		$query = "UPDATE users SET active=1 WHERE id=$id";
		$stmt = $pdo->prepare($query);
		$stmt->execute();
		$_SESSION['usr'] = $usr;
		header("Location: index.php");
	}
	catch (PDOException $e)
	{
		echo $e->getMessage();
	}
}
?>