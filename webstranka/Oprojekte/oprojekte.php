<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring prostredia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="icon" href="../obrazky/favicon-32x32.png" type="../obrazky/icon">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    


    <?php include '../headfoot/header.php'; ?> <!-- Načítanie navigácie -->
    <!-- Bootstrap JS (pripojenie jQuery a Popper.js je zahrnuté v Bootstrap 5) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


</head>

    <header class="bg-primary text-white text-center py-5">
        <div id="currentDateTime" class="mt-3 fs-4"></div>
        <div class="container" >
           <h1>O projekte</h1>
            <p class="lead">Projekt sleduje environmentálne podmienky pomocou IoT - ESP32 a senzorov BME 680.</p>
        
    </header>
<body>
    
    <section class="container text-center my-5">
        <h2></h2>
        <p class="lead">Tento projekt vznikol ako semestrálna práca pre predmety <strong>Aplikácia internetu vecí 2</strong> a <strong>Webový dizajn 2</strong>. Cieľom bolo navrhnúť a vytvoriť funkčný systém meteostanice, ktorá zhromažďuje údaje z prostredia a sprístupňuje ich prostredníctvom webového rozhrania.</p>
        <p class="lead">Pri realizácii projektu som využil svoje znalosti z oblasti programovania mikrokontrolérov ESP32, ako aj z webových technológií PHP a Bootstrap. ESP32 zabezpečuje zber a odosielanie senzorických údajov, zatiaľ čo webová aplikácia ich spracováva, uchováva v databáze a zobrazuje vo vizuálne prehľadnej forme.</p>
        <p class="lead">Projekt je ukážkou prepojenia hardvéru s webovým rozhraním a predstavuje praktické využitie internetu vecí (IoT) v reálnych podmienkach.</p>
        
        <img src="../obrazky/meteostanica2.jpg" alt="Ilustrácia prostredia" class="img-fluid rounded mt-3" width="60%">
         <p class="lead"><small>Vypnutá domová stanica</small></p>
          <p class="lead"></p>
          <img src="../obrazky/meteostanica.jpg" alt="Ilustrácia prostredia" class="img-fluid rounded mt-3" width="60%">
         <p class="lead"><small>Zapnutá domová stanica</small></p
          <p class="lead"></p>
          <img src="../obrazky/externajednotka.jpg" alt="Ilustrácia prostredia" class="img-fluid rounded mt-3" width="60%">
         <p class="lead"><small>Externá jednotka</small></p
          <p class="lead"></p>
    </section>

    <?php include '../headfoot/footer.php'; ?> <!-- Načítanie pätičky -->

    <script>
        // Funkcia na načítanie údajov zo senzora
        function fetchSensorData() {
    $.ajax({
        url: 'Scripts/fetch_data.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Formátovanie dátumu do dd.mm.yyyy
            let datumParts = data.datum.split('-'); 
            let formattedDate = datumParts[2] + '.' + datumParts[1] + '.' + datumParts[0];
            let dateTime = formattedDate + ' ' + data.cas;

            $('#teplota').text(data.teplota);
            $('#vlhkost').text(data.vlhkost);
            $('#tlak').text(data.tlak);
            $('#plyn').text(data.plyn);
            $('#datumCas').text(dateTime);
        },
        error: function(xhr, status, error) {
            console.error("Chyba pri načítaní údajov:", status, error);
            $('#sensorData').html('<p class="text-danger">Chyba pri načítaní údajov.</p>');
        }
    });
}

        setInterval(fetchSensorData, 5000);
        fetchSensorData();

        document.getElementById("themeToggle").addEventListener("click", function() {
            document.body.classList.toggle("dark-mode");
            localStorage.setItem("theme", document.body.classList.contains("dark-mode") ? "dark" : "light");
        });
        if (localStorage.getItem("theme") === "dark") {
            document.body.classList.add("dark-mode");
        }

        function updateDateTime() {
            let now = new Date();
            let dateTimeString = now.toLocaleDateString('sk-SK', { 
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' 
            }) + ' - ' + now.toLocaleTimeString('sk-SK');
            
            document.getElementById("currentDateTime").textContent = dateTimeString;
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>
    
</body>
</html>
