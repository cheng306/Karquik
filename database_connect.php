<?php
$dbservername = "comp380gp4.cztejaciasub.us-west-2.rds.amazonaws.com";
$dbusername = "comp380";
$dbpassword = "comp380gp4";
$dbname = "comp380gp4";

$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 
?>