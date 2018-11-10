<?php

require_once("./config/database.php");
require_once("./config/connect.php");

session_start();

?>

<html>
	<head>
		<title>Camagru</title>
		<link rel="stylesheet" href="camagru.css">
	</head>
	<body>
		<div class="header">
				<a href="index.php"><button class="title" type="button">Camagru</button></a>
				<?php 
				if (isset($_SESSION) && !empty($_SESSION['usr']))
				{
					?>
					<a href="webcam.php"><button class="signup" type="button">Webcam</button> </a>
					<a href="profile_front.php"><button class="signup" type="button"><?php echo $_SESSION['usr'] ?></button> </a>
					<a href="signout.php"><button class="signup" type="button">Sign out</button> </a>
					<?php
				}
				else
				{
					?>
					<a href="register_front.php"><button class="signup" type="button">Signup</button> </a>
					<a href="login_front.php"><button class="signup" type="button">Login</button> </a>
				<?php 
	   			 }
				?>
		</div>
	</body>
</html>