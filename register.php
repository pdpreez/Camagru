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
		if (preg_match( '~[A-Z]~', $pwd) && preg_match( '~[a-z]~', $pwd) && preg_match( '~\d~', $pwd) && (strlen( $pwd) > 8)){
			$pwd = hash('md5', $pwd);
			$id = uniqid();
			$query = $pdo->prepare("INSERT INTO users (username, email, passwd, uniqid) VALUES (:usr, :email, :pwd, :uniqid)");
			$query->execute(['usr' => $usr, 'email' => $email, 'pwd' => $pwd, 'uniqid' => $id]);
			$_SESSION['usr'] = $usr;

			$link = "http://" . $_SERVER['HTTP_HOST'];
			$link .= str_replace('register', 'verify', $_SERVER['SCRIPT_NAME']);
			$to = $email;
			$subject = "Activate your Camagru account";
			$txt = "Hey there, " . $usr . "!\n";
			$txt .= "Please click the following link to verify your account registration: \n";
			$txt .= $link . "?usr=$usr&email=$email&id=$id";
			$headers = "From: noreply@camagru.com";

			mail($to,$subject,$txt,$headers);
			header("Location: signout.php");
		}
	else{
		header("Location: register_front.php");
		die();
		}
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