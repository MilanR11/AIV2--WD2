<?php
include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring prostredia - Grafy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <link rel="icon" href="../obrazky/favicon-32x32.png" type="../obrazky/icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    



</head>
<body>
    <?php include '../headfoot/header.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    
    
    <header class="bg-primary text-white text-center py-5">
        <h1>Monitoring prostredia - Grafy</h1>
        <div class="text-center my-3">
    
</div>

    </header>

    <section class="container my-5">
        <h2>Filtrovanie údajov</h2>
        <form method="GET" action="" class="row g-3">
            <div class="col-md-3">
                <label for="start_date">Začiatok:</label>
                <input type="date" name="start_date" id="start_date" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="end_date">Koniec:</label>
                <input type="date" name="end_date" id="end_date" class="form-control">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary mt-4">Filtrovať</button>
            </div>
        </form>
    </section>

    <section class="container">
        <h2>Grafy údajov</h2>
        <canvas id="tempChart"></canvas>
        <canvas id="humidityChart" class="mt-4"></canvas>
        <canvas id="pressureChart" class="mt-4"></canvas>
        <canvas id="qualityChart" class="mt-4"></canvas>
    </section>

    <?php
    $query = "SELECT * FROM espdata WHERE 1=1";
    if (!empty($_GET['start_date'])) {
        $query .= " AND datum >= '" . $_GET['start_date'] . "'";
    }
    if (!empty($_GET['end_date'])) {
        $query .= " AND datum <= '" . $_GET['end_date'] . "'";
    }
    $result = $conn->query($query);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    ?>
    <?php include '../headfoot/footer.php'; ?> <!-- Načítanie pätičky -->

    <script>
        let rawData = <?php echo json_encode($data); ?>;
        let labels = rawData.map(row => row.datum + ' ' + row.cas);
        let tempData = rawData.map(row => row.teplota);
        let humidityData = rawData.map(row => row.vlhkost);
        let pressureData = rawData.map(row => row.tlak);
        let plynData = rawData.map(row => row.plyn);

        function createChart(canvasId, label, data, color) {
            new Chart(document.getElementById(canvasId), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        borderColor: color,
                        fill: false
                    }]
                }
            });
        }

        createChart('tempChart', 'Teplota (°C)', tempData, 'red');
        createChart('humidityChart', 'Vlhkosť (%)', humidityData, 'blue');
        createChart('pressureChart', 'Tlak (hPa)', pressureData, 'green');
        createChart('qualityChart', 'Kvalita (%)', plynData, 'yellow');
    </script>
</body>
</html>
