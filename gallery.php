<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();

if (isset($_GET['page']) && !empty($_GET['page'])){
	$page = intval($_GET['page']);
}
else{
	$page = 0;
}
$offset = $page * 5;
echo $offset;
$result = $pdo->query("SELECT * from images ORDER BY created DESC LIMIT $offset, 5");
$fetched = $result->fetchAll();

print_r($fetched);
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
$next = $page + 1;
$back = $page - 1;
if ($page > 0)
	echo "<a href='index.php?page=".$back."' id='likes'>Back</a>";
echo "<a href='index.php?page=".$next."' id='likes'>Next</a>";

?>