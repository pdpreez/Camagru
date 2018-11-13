<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();

if (isset($_SESSION) && !empty($_SESSION['id']))
{
	$query = $pdo->prepare("SELECT * FROM images WHERE id=?");
	$query->execute([$_GET['id']]);
	$fetched = $query->fetch();
	$img_name = $fetched['img_name'];
	$img_id = $fetched['id'];
	$u_id = $fetched['u_id'];
	if ($img_name)
		echo "<img src='{$img_name}' class='gallery'/>";
	echo "<div>";
	echo "<a href='edit_image_front.php?id={$_GET['id']}&sticker=glasses'><img id='sticker' src='./stickers/glasses.png'></a>";
	echo "<a href='edit_image_front.php?id={$_GET['id']}&sticker=beard'><img id='sticker' src='./stickers/beard.png'></a>";
	echo "<a href='edit_image_front.php?id={$_GET['id']}&sticker=pizza'><img id='sticker' src='./stickers/pizza.png'></a>";
	echo "</div>";
	echo "<a href='save_edit.php?id=$img_id' id='likes'>Save edited</a>";

	if (isset($_GET['sticker'])){
		$sticker = imagecreatefrompng("./stickers/" . $_GET['sticker'] . ".png");
		$image = file_get_contents($img_name);
		$image = imagecreatefromstring($image);
		$sticker = imagescale($sticker, 100);
		$sticker_width = imagesx($sticker);
		$sticker_height = imagesy($sticker);
		// $image_width = imagesx($image);
		// $image_width = imagesy($image);

		$size_x = 0;
		$size_y = 0;

		imagecopy($image, $sticker, $size_x, $size_y, 0, 0, $sticker_width, $sticker_height);
		echo "<img src='$image'>";
		
	}
}

?>