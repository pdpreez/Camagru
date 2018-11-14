<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();
ini_set('memory_limit', '1g');
if (isset($_SESSION) && !empty($_SESSION['id']))
{
	if (file_exists("save.png") && !isset($_GET['sticker']))
		unlink("save.png");
	$query = $pdo->prepare("SELECT * FROM images WHERE id=?");
	$query->execute([$_GET['id']]);
	$fetched = $query->fetch();
	$img_name = $fetched['img_name'];
	$img_id = $fetched['id'];
	$u_id = $fetched['u_id'];
	if ($img_name)
		echo "<img src='{$img_name}' class='gallery'/>";
	if (isset($_GET['sticker']))
		echo "<img src='save.png' class='gallery'>";
	echo "<div>";
	echo "<a href='edit_image_front.php?id={$_GET['id']}&sticker=glasses'><img id='sticker' src='./stickers/glasses.png'></a>";
	echo "<a href='edit_image_front.php?id={$_GET['id']}&sticker=beard'><img id='sticker' src='./stickers/beard.png'></a>";
	echo "<a href='edit_image_front.php?id={$_GET['id']}&sticker=pizza'><img id='sticker' src='./stickers/pizza.png'></a>";
	echo "</div>";
	echo "<a href='edit_image_front.php?id=$img_id' id='likes'>Reset image</a>";
	if (isset($_GET['sticker']))
		echo "<a href='save_edit.php?id=$img_id' id='likes'>Save edited</a>";

	if (isset($_GET['sticker'])){
		$sticker = imagecreatefrompng("./stickers/" . $_GET['sticker'] . ".png");
		if (file_exists("save.png"))
			$image = file_get_contents("save.png");
		else
			$image = file_get_contents($img_name);
		$image = imagecreatefromstring($image);

		
		$image_width = imagesx($image);
		$image_height = imagesy($image);

		$og_height = imagesy($sticker);
		$og_width = imagesx($sticker);
		$sticker_height = imagesy($image) / 2;
		$sticker_width = imagesy($image) * $image_width / $image_height / 2;

		$sticker_resize = imagecreatetruecolor($sticker_width, $sticker_height);
		imagealphablending($sticker_resize, false);
		imagesavealpha($sticker_resize, true);
		imagecopyresampled($sticker_resize, $sticker, 0, 0, 0, 0, $sticker_width, $sticker_height, $og_width, $og_height);
 
		$size_x = 0;
		$size_y = 0;

		imagecopy($image, $sticker_resize, $size_x, $size_y, 0, 0, $sticker_width, $sticker_height);
		imagepng($image, 'save.png');
		
	}
}

?>