<?php

require_once("header.php");

?>

<html>
	<div style="display: grid;margin-left: 40%">	
		<form action="forgot_password.php" method="POST">
		Email <br><input type="email" name="email"><br>
		<br><input type="submit" name="submit" value="Send reset email"><br>
	</div>
</html>