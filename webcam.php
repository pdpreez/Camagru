<?php

require_once("header.php");

?>

<html>
<div>
	<form id="upload" method="POST" action="save_uploaded.php" enctype="multipart/form-data">
		Upload your own picture
		<input type="file" name="file" id="file">
		<input type="submit" value="Click to upload" name="submit">
	</form>
</div>
<div class="webcam">
	<video id="video" height="300" width="400"> </video>
	<a href="#" id="click" class="webcam-click-button">Click</a>
	<canvas id="canvas" style="display: none" height="300" width="400"></canvas>
	<img id="image" style="display: none" src="none" alt="Your webcam photo">
	<form id="save_form" action="save_img.php" method="POST">
		<button id="save" style="display: none" class="button">Save photo</button>
		<input id="input" name="input" value="none" style="display: none">
	</form>
</div>
	<script src="webcam.js"></script>

</html>