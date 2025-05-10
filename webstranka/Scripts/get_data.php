<?php
header("Content-Type: application/json");

$servername = "86.110.243.72"; // Alebo iný podľa hostingu
$username = "id041500";
$password = "M4iufPk7aUHqePyjxeYmGg";
$dbname = "id041500db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

$sql = "SELECT * FROM espdata ORDER BY id DESC LIMIT 1";  
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["error" => "No data found"]);
}

$conn->close();
?>
