<?php
$host = "localhost";
$user = "root";     // change if needed
$pass = "";         // change if you set a password for MySQL
$dbname = "mobile_shop_db";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>