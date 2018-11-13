<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();

$id = $_SESSION['id'];
$usr = $_SESSION['usr'];
$email = $_SESSION['email'];
$pwd = $_POST['pwd'];
$pwd2 = $_POST['confirmpwd'];

if (!empty($pwd) && !empty($pwd2) && $pwd === $pwd2 && isset($_SESSION) && !empty($_SESSION['usr'])){
	$pwd = hash('md5', $pwd);
	$query = $pdo->prepare("UPDATE users SET passwd=? WHERE id=$id");
	$query->execute([$pwd]);
	header("Location: index.php");
	exit();
}
header("Location: password_front.php");

?>