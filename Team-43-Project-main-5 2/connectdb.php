<?php
$db_host = 'localhost';
$db_name = 'fragrancedb';
$username = 'root';
$password = '';

try{
    $db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo("Successfully connected to the database.<br>");
} catch(PDOException $ex) {
	echo("Failed to connect to the database.<br>");
	echo($ex->getMessage());
	exit;
}
?>