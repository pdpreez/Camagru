<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();

$usr = $_POST['username'];
$pwd = $_POST['password'];
$sub = $_POST['submit'];

if ($sub == 'Login')
{
    try{
		$pwd = hash('md5', $pwd);
        $query = $pdo->prepare("SELECT count(*) FROM users WHERE username=? AND passwd=? AND active=1");
        $query->execute([$usr, $pwd]);
		$result = $query->fetch();
        if ($result['count(*)'] > 0){
			$query = $pdo->prepare("SELECT * FROM users WHERE username=? AND passwd=? AND active=1");
			$query->execute([$usr, $pwd]);
			$result = $query->fetch();
			$_SESSION['id'] = $result['id'];
			$_SESSION['usr'] = $result['username'];
			$_SESSION['email'] = $result['email'];
		}
		else
			session_unset();
		header("Location: index.php");
    }
    catch(PDOException $err){
        echo $pdo . "Error: " . $err->getMessage();
    }
}
?>
