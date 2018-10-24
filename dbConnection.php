<?php
global $db;

require_once 'serverSettings.php';
$servername 	= $PanaceaServer["db"]["servername"];
$databaseName	= $PanaceaServer["db"]["databaseName"];
$username 		= $PanaceaServer["db"]["username"];
$password 		= $PanaceaServer["db"]["password"];

// Create connection
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

$db = $conn;

?>