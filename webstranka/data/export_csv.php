<?php
include '../grafy/db_connection.php'; // Načítanie pripojenia k databáze

// Skontrolujeme, či sú parametre filtrovania prítomné
$where = "WHERE 1=1";

// Filtrovanie podľa dátumu
if (isset($_GET['start_date']) && !empty($_GET['start_date'])) {
    $start_date = $_GET['start_date'];
    $where .= " AND datum >= '$start_date'";
}

if (isset($_GET['end_date']) && !empty($_GET['end_date'])) {
    $end_date = $_GET['end_date'];
    $where .= " AND datum <= '$end_date'";
}

// Filtrovanie podľa teploty
if (isset($_GET['min_temp']) && !empty($_GET['min_temp'])) {
    $min_temp = $_GET['min_temp'];
    $where .= " AND teplota >= $min_temp";
}

if (isset($_GET['max_temp']) && !empty($_GET['max_temp'])) {
    $max_temp = $_GET['max_temp'];
    $where .= " AND teplota <= $max_temp";
}

// SQL dopyt na získanie údajov
$query = "SELECT teplota, vlhkost, tlak, plyn, datum, cas FROM espdata $where";

// Vykonanie dopytu
$result = $conn->query($query);

// Kontrola, či sú dáta
if ($result->num_rows > 0) {
    // Nastavenie hlavičky pre CSV export
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="export_data.csv"');
    $output = fopen('php://output', 'w');

    // Zápis hlavičky CSV súboru
    fputcsv($output, ['Teplota (°C)', 'Vlhkosť (%)', 'Tlak (hPa)', 'Kvalita ovzdušia (ppm)', 'Dátum', 'Čas']);

    // Zápis údajov do CSV
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [$row['teplota'], $row['vlhkost'], $row['tlak'], $row['plyn'], $row['datum'], $row['cas']]);
    }

    // Uzavretie CSV súboru
    fclose($output);
    exit;
} else {
    echo "Žiadne údaje na export.";
}
?>
