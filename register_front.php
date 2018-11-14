<?php

	require_once("header.php");

?>

<html>
  <div style="display: grid;margin-left: 40%">
  <h1> User Registration </h1>
        <form action="register.php" method="POST">
            Username        <br><input type="text" name="username"><br>
            Email           <br><input type="email" name="email"><br>
            Password        <br><input type="password" name="passwd" minlength="8" ><br>
            Confirm Password<br><input type="password" name="passwdconfirm" minlength="8" ><br>
            <br><input id="register" type="submit" name="submit" value="Register" onkeyup='validate(this.value);'><br>
        </form>
	</div>
	<script src='pwd.js'></script>
</html>