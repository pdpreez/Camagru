<?php

require_once("header.php");

?>

<html>
  <div style="display: grid;margin-left: 40%">
  <h1> Login </h1>
    <form action=login.php method="POST">
        Username<br><input type="text" name="username"><br>
        Password<br><input type="password" name="password"><br>
        <br><input type="submit" name="submit" value="Login"><br>
    </form>
	<a href="forgot_password_front.php"><input type="button" name="forgot_password" value="Forgot password?"></a>
	</div>
</html>