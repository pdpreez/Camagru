<?php

require_once("header.php")

?>

<html>
  <div style="display: grid;margin-left: 40%">
	<h1> Update profile info </h1>
        <form action="profile.php" method="POST">
            Username        <br><input type="text" name="username"><br>
            Email           <br><input type="email" name="email"><br>
			<br><input type="checkbox" name="notify" value="notify" checked>I would like to receive notifications through email.<br>
            <br><input type="submit" name="submit" value="Update"><br>
		</form>
		<a href="password_front.php"><input type="button" name="chpwd" value="Change password"></a>
	</div>
</html>