<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();

if (isset($_SESSION) && !empty($_SESSION['id']))
{
	$query = $pdo->prepare("SELECT * FROM images WHERE id=?");
	$query->execute([$_GET['img']]);
	$fetched = $query->fetch();
	$img_name = $fetched['img_name'];
	$img_id = $fetched['id'];
	$u_id = $fetched['u_id'];
	if ($img_name)
		echo "<img src='{$img_name}' class='gallery'/>";

	$query = $pdo->prepare("SELECT count(*) FROM likes WHERE id=? AND liked=1");
	$query->execute([$_GET['img']]);
	$result = $query->fetch();
	$likes = $result['count(*)'];
	if ($img_name)
		echo "<a href='like_image.php?id={$img_id}' id='likes'> Likes $likes </a>";
	if ($_SESSION['id'] == $u_id)
		echo "<a href='delete_image.php?id={$img_id}' id='likes'> Delete pic </a>";
}

?>