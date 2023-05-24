<?php
$username = "tcceteclins";
$password = "e12aa853";
$host = "db4free.net";
$dbname = "tcceteclins";

try {
    $conn = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
} catch (PDOException $ex) {
    die("Failed to connect to the database: " . $ex->getMessage());
}
