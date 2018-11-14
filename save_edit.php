<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();

if (isset($_SESSION) && !empty($_SESSION['id'])){

	$query = $pdo->prepare("SELECT img_name FROM images WHERE id=?");
	$query->execute([$_GET['id']]);
	$result = $query->fetch();
	$new = $result['img_name'];
	$new_data = file_get_contents("save.png");
	echo "Breakpoint";
	unlink($result['img_name']);
	file_put_contents($new, $new_data);
	$id = $_GET['id'];
	$query = $pdo->prepare("UPDATE images SET created=CURRENT_TIMESTAMP WHERE id=$id");
	$query->execute();
}

header("Location: index.php");

?>