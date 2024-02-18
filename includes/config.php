<?php


$host = "localhost";
$user = "root";
$pass = "";
$db = "ocim_db";
$s3Url = "student/uploads/";


$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
	echo "Failed:" . $conn->connect_error;
}
