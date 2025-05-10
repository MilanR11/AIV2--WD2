<?php
$servername = "86.110.243.72";
$username = "id041500";
$password = "M4iufPk7aUHqePyjxeYmGg";
$dbname = "id041500db";

// Pripojenie k databáze
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrola pripojenia
if ($conn->connect_error) {
    die(json_encode(["error" => "Chyba pripojenia: " . $conn->connect_error]));
}

// Načítanie posledného záznamu
$sql = "SELECT teplota, vlhkost, tlak, plyn, cas, datum FROM espdata ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["error" => "Žiadne údaje v databáze"]);
}

$conn->close();
?>
