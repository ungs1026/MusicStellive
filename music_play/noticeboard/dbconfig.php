<?php
$servername = 'localhost';
$user = 'root';
$pass = '';
$db = 'stellive';

try{
	$conn = new PDO("mysql:host=".$servername.";dbname=".$db, $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// echo "DB Connection Success <br>";
} catch (PDOException $e) {
	echo "Connection failed: ". $e->getMessage();
}