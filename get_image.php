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

	$query = $pdo->prepare("SELECT count(*) FROM likes WHERE img_id=?");
	$query->execute([$_GET['img']]);
	$result = $query->fetch();
	$likes = $result['count(*)'];
	if ($img_name)
		echo "<a href='like_image.php?id={$img_id}' id='likes'> Likes $likes </a>";
	if ($_SESSION['id'] == $u_id){
		echo "<a href='edit_image_front.php?id={$img_id}' id='likes'> Edit pic </a>";
		echo "<a href='delete_image.php?id={$img_id}' id='likes'> Delete pic </a>";
	}
	if ($img_name){
		echo "<form id='comment_form' action='save_comment.php' method='GET' >";
		echo "<p><textarea rows='4' cols='64' name='comment' form='comment_form' placeholder='Enter comment here...'></textarea>";
		echo "<input type='submit' value='Comment'></input>";
		echo "<input type='hidden' name='id' value='{$img_id}'></form>";
	}
	if ($img_name){
		$query = $pdo->prepare("SELECT * FROM comments WHERE img_id=? ORDER BY created DESC");
		$query->execute([$img_id]);
		$result = $query->fetchAll();
		foreach ($result as $comment){
			$query = $pdo->prepare("SELECT username FROM users WHERE id=?");
			$query->execute([$comment['u_id']]);
			$name = $query->fetch();
			echo "<p style='margin: 0 30px;color: grey;font-size: 14px'>" . $name['username'] . " - " . $comment['created'] . "</p>";
			echo "<p style='margin: 0 30px'>" . $comment['comments'] . "</p>";
		}
	}
}

?>