<?php
require_once("header.php");
?>

<html>
<div style="display: grid;margin-left: 40%">
<form action="password.php" method="POST">
			New password		<br><input type="password" name="pwd"><br>
			Confirm password	<br><input type="password" name="confirmpwd"><br>
			<br><input type="submit" name="submit" value="Update"><br>
</form>
</div>
	</html>