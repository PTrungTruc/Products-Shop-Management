<?php
//mysqli_connect(host, username, password, databasename, port, socket)
$conn = mysqli_connect('localhost', 'root', '', 'demo');

if ($conn == false) {
	die("Database connection failed");
} else {
	// echo "Connection success.";
}
?>
