<?php

require_once("header.php");
require_once("./config/database.php");
require_once("./config/connect.php");


if ((isset($_GET) && !empty($_GET['usr'])) && !empty($_GET['email']))
{	
	$usr = $_GET['usr'];
	$email = $_GET['email'];
	$uniqid = $_GET['id'];
	try{
		$query = $pdo->prepare("SELECT id FROM users WHERE username=? AND email=? AND uniqid=?");
		$query->execute([$usr, $email, $uniqid]);
		$id = $query->fetch();
		$id = $id['id'];
		$query = "UPDATE users SET active=1 WHERE id=$id";
		$stmt = $pdo->prepare($query);
		$stmt->execute();
		$_SESSION['usr'] = $usr;
		header("Location: signout.php");
	}
	catch (PDOException $e)
	{
		echo $e->getMessage();
	}
}
?>