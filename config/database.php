<?php
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_database = 'sinhvien1';

$conn = new mysqli($db_host, $db_user, $db_password, $db_database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>