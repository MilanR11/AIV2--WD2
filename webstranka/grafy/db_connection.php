<?php
$servername = "86.110.243.72";
$username = "id041500";
$password = "M4iufPk7aUHqePyjxeYmGg";
$dbname = "id041500db"; // Názov databázy

// Vytvorenie pripojenia
$conn = new mysqli($servername, $username, $password, $dbname);

// Skontrolovanie pripojenia
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
