<!-- HEADER -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 shadow animate-fade-in">
    <div class="container d-flex align-items-center justify-content-between">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center animate-logo" href="../index.php">
            <img src="../obrazky/logo.png" alt="Logo" height="40" class="me-2">
            <span class="fw-bold">Monitoring prostredia</span>
        </a>

        <!-- Čas a používateľ -->
        <div class="d-flex align-items-center gap-4">
            <!-- Hodiny -->
            <div id="time" class="text-info fs-6 animate-time">
                <!-- čas sa zobrazí cez JS -->
            </div>

            <!-- Používateľ -->
            <div class="text-white d-flex align-items-center">
                <i class="bi bi-person-circle fs-5 me-2 text-primary"></i>
                <span id="username" class="fw-light">Používateľ</span>
            </div>
        </div>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>

    <!-- Navigačné odkazy -->
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link animate-link" href="../index.php"><i class="bi bi-house-door-fill me-1"></i>Domov</a></li>
                <li class="nav-item"><a class="nav-link animate-link" href="../grafy/grafy.php"><i class="bi bi-graph-up-arrow me-1"></i>Grafy</a></li>
                <li class="nav-item"><a class="nav-link animate-link" href="../data/data.php"><i class="bi bi-database-fill me-1"></i>Údaje</a></li>
                <li class="nav-item"><a class="nav-link animate-link" href="../Oprojekte/oprojekte.php"><i class="bi bi-info-circle-fill me-1"></i>O projekte</a></li>
                <li class="nav-item"><a class="nav-link animate-link" href="../login/logout.php"><i class="bi bi-box-arrow-right me-1"></i>Odhlásiť sa</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- ŠTÝLY -->
<style>
    .animate-fade-in {
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-link {
        position: relative;
        transition: color 0.3s ease;
    }

    .animate-link::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0%;
        height: 2px;
        background-color: #0dcaf0;
        transition: width 0.3s ease;
    }

    .animate-link:hover {
        color: #0dcaf0;
    }

    .animate-link:hover::after {
        width: 100%;
    }

    .animate-logo {
        transition: transform 0.3s ease;
    }

    .animate-logo:hover {
        transform: scale(1.05);
    }

    #time {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 16px;
        font-weight: 500;
        padding: 4px 10px;
        background-color: rgba(13, 202, 240, 0.1);
        border-radius: 6px;
        border: 1px solid rgba(13, 202, 240, 0.3);
    }
</style>

<!-- SKRIPT NA ČAS A POUŽÍVATEĽA -->
<script>
    // Čas
    function updateTime() {
        const now = new Date();
        const day = String(now.getDate()).padStart(2, '0');
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const year = now.getFullYear();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        const formattedTime = `${day}.${month}.${year} ${hours}:${minutes}:${seconds}`;
        document.getElementById('time').textContent = formattedTime;
    }

    setInterval(updateTime, 1000);
    updateTime();

    // Používateľ (z PHP session, ak ju používaš)
    document.addEventListener("DOMContentLoaded", function () {
        const userName = "<?php echo $_SESSION['username'] ?? 'Vitaj admin'; ?>";
        document.getElementById("username").textContent = userName;
    });
</script>
