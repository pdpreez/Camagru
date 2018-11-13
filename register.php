<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();

$usr = $_POST['username'];
$email = $_POST['email'];
$pwd = $_POST['passwd'];
$pwd2 = $_POST['passwdconfirm'];


if ($pwd === $pwd2 && !empty($pwd) && !empty($usr) && !empty($email)){
    try{
		$pwd = hash('md5', $pwd);
        $query = $pdo->prepare("INSERT INTO users (username, email, passwd) VALUES (:usr, :email, :pwd)");
        $query->execute(['usr' => $usr, 'email' => $email, 'pwd' => $pwd]);
		$_SESSION['usr'] = $usr;

		$to = $email;
		$subject = "Activate your Camagru account";
		$txt = "Hey there, " . $usr . "!\n";
		$txt .= "Please click the following link to verify your account registration: \n";
		$txt .= "http://localhost:8080/Web/Camagru/verify.php?usr=$usr&email=$email";
		$headers = "From: noreply@camagru.com";

		mail($to,$subject,$txt,$headers);
		header("Location: signout.php");
    }
    catch (PDOException $err)
    {
        header("Location: index.php");
        die();
    }
}
else

    header("Location: index.php");
?>