<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();

$result = $pdo->query("SELECT * from images ORDER BY created DESC");
$fetched = $result->fetchAll();
foreach($fetched as $img)
{
	$img_name = $img['img_name'];
	$img_id = $img['id'];
	if ($img_name){
		if (isset($_SESSION) && !empty($_SESSION['id']))
			echo "<a href='./view_image.php?img=".$img_id."'>";
		echo "<img src='{$img_name}' class='gallery'></a>";
	}
}

?>