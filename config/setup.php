<?php

require_once("database.php");

try {
	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("DROP DATABASE IF EXISTS `$mydb`");
	$conn->query("CREATE DATABASE `$mydb`");
    echo "Database created successfully<br>";
}
catch (PDOException $e){
    echo $e->getMessage() . "<br>" . $conn;
}

$table = "CREATE TABLE IF NOT EXISTS users (
	id int(9) unsigned AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(32) NOT NULL UNIQUE KEY,
    email VARCHAR(64) NOT NULL UNIQUE KEY,
    passwd VARCHAR(128),
	uniqid VARCHAR(32),
	notify BIT NOT NULL DEFAULT true,
	active BIT NOT NULL DEFAULT false
    );";

$conn->query("use `$mydb`");
$conn->exec($table);
echo "<br>" . "users table created successfully";

$table = "CREATE TABLE IF NOT EXISTS images (
	id int(9) unsigned AUTO_INCREMENT PRIMARY KEY,
	u_id int(9) unsigned NOT NULL, 
	img_name text NOT NULL,
	created DATETIME DEFAULT CURRENT_TIMESTAMP
	
	);";

$conn->query("use `$mydb`");
$conn->exec($table);
echo "<br>" . "images table created successfully";

$table = "CREATE TABLE IF NOT EXISTS likes (
	id int(9) unsigned AUTO_INCREMENT PRIMARY KEY,
	img_id int(9) unsigned NOT NULL,
	u_id int(9) unsigned NOT NULL,
	liked BIT DEFAULT false
);";

$conn->query("use `$mydb`");
$conn->exec($table);
echo "<br>" . "likes table created successfully";

$table = "CREATE TABLE IF NOT EXISTS comments(

	id int(9) unsigned AUTO_INCREMENT PRIMARY KEY,
	img_id int(9) unsigned NOT NULL,
	u_id int(9) unsigned NOT NULL,
	created DATETIME DEFAULT CURRENT_TIMESTAMP,
	comments VARCHAR(256)

);";

$conn->query("use `$mydb`");
$conn->exec($table);
echo "<br>" . "comments table created successfully";

$pwd = 'secret';

$pwd1 = hash('md5', 'secret');
$pwd2 = hash('md5', 'shhh');
$pwd3 = hash('md5', 'hush');

$id1 = uniqid();
$id3 = uniqid();
$id2 = uniqid();

$query = $conn->prepare("INSERT INTO users (username, email, passwd, active, uniqid) VALUES (?, ?, ?, true, ?)");
$query->execute(['ppreez', 'pdpreez412@gmail.com', $pwd1, $id1]);
$query->execute(['rhohls', 'rhohls@email.com', $pwd2, $id2]);
$query->execute(['dponsonb', 'dponsonb@email.com', $pwd3, $id3]);

?>