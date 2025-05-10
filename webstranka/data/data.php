<?php
include '../grafy/db_connection.php'; // Načítanie pripojenia k databáze
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Údaje - Monitoring prostredia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="icon" href="../obrazky/favicon-32x32.png" type="../obrazky/icon">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
<body>

    <?php include '../headfoot/header.php'; ?>
    <!-- Bootstrap JS (pripojenie jQuery a Popper.js je zahrnuté v Bootstrap 5) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


    <header class="bg-primary text-white text-center py-5">
        <h1>Údaje z monitoringu prostredia</h1>
        <p class="lead">Zobraziť všetky údaje zo senzora BME680 s možnosťou filtrovania a exportu do CSV.</p>
    </header>

    <section class="container my-5">
        <h2>Filtrovanie údajov</h2>
        <form method="GET" action="data.php" class="d-flex align-items-center">
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="start_date">Začiatok:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">
                </div>
                <div class="col-md-3">
                    <label for="end_date">Koniec:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">
                </div>
                <div class="col-md-3">
                    <label for="min_temp">Min. teplota:</label>
                    <input type="number" step="0.1" name="min_temp" id="min_temp" class="form-control" value="<?= isset($_GET['min_temp']) ? $_GET['min_temp'] : '' ?>">
                </div>
                <div class="col-md-3">
                    <label for="max_temp">Max. teplota:</label>
                    <input type="number" step="0.1" name="max_temp" id="max_temp" class="form-control" value="<?= isset($_GET['max_temp']) ? $_GET['max_temp'] : '' ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3 ms-3">Filtrovať</button>
            <a href="export_csv.php?<?= http_build_query($_GET) ?>" class="btn btn-success mt-3 ms-3">Exportovať do CSV</a>
        </form>
    </section>

    <section class="container">
        <h2>Údaje zo senzora</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Teplota (°C)</th>
                    <th>Vlhkosť (%)</th>
                    <th>Tlak (hPa)</th>
                    <th>Kvalita ovzdušia (ppm)</th>
                    <th>Čas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // SQL dopyt na získanie údajov
                $query = "SELECT * FROM espdata WHERE 1=1";

                // Filtrovanie podľa dátumu
                if (isset($_GET['start_date']) && !empty($_GET['start_date'])) {
                    $start_date = $_GET['start_date'];
                    $query .= " AND datum >= '$start_date'";
                }

                if (isset($_GET['end_date']) && !empty($_GET['end_date'])) {
                    $end_date = $_GET['end_date'];
                    $query .= " AND datum <= '$end_date'";
                }

                // Filtrovanie podľa teploty
                if (isset($_GET['min_temp']) && !empty($_GET['min_temp'])) {
                    $min_temp = $_GET['min_temp'];
                    $query .= " AND teplota >= $min_temp";
                }

                if (isset($_GET['max_temp']) && !empty($_GET['max_temp'])) {
                    $max_temp = $_GET['max_temp'];
                    $query .= " AND teplota <= $max_temp";
                }

                // Vykonanie dopytu
                $result = $conn->query($query);

                // Zobrazenie údajov
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['teplota']}</td>
                            <td>{$row['vlhkost']}</td>
                            <td>{$row['tlak']}</td>
                            <td>{$row['plyn']}</td>
                            <td>{$row['datum']} {$row['cas']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    
    <?php include '../headfoot/footer.php'; ?> <!-- Načítanie pätičky -->
    <script>
        document.getElementById("themeToggle").addEventListener("click", function() {
            document.body.classList.toggle("dark-mode");
            localStorage.setItem("theme", document.body.classList.contains("dark-mode") ? "dark" : "light");
        });

        if (localStorage.getItem("theme") === "dark") {
            document.body.classList.add("dark-mode");
        }
    </script>

</body>
</html>
