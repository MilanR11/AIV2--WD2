<?php
$servername = "86.110.243.72"; // Alebo IP adresa databázového servera
$username = "id041500";
$password = "M4iufPk7aUHqePyjxeYmGg";
$dbname = "id041500db";

$teplota = $_GET['teplota'];
$vlhkost = $_GET['vlhkost'];
$tlak = $_GET['tlak'];
$plyn = $_GET['plyn'];

// Vytvorenie spojenia
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrola spojenia
if ($conn->connect_error) {
  die("Spojenie zlyhalo: " . $conn->connect_error);
}

// Vytvorenie SQL dotazu
$sql = "INSERT INTO espdata (teplota, vlhkost, tlak, plyn) VALUES ($teplota, $vlhkost, $tlak, $plyn)";

if ($conn->query($sql) === TRUE) {
  echo "Dáta boli úspešne vložené";
} else {
  echo "Chyba: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>