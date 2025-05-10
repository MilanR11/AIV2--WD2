<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === "admin" && $password === "1234") {
        $_SESSION['loggedin'] = true;
        header("Location: ../index.php");
        exit;
    } else {
        $error = "Nesprávne meno alebo heslo.";
    }
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Prihlásenie | Monitoring prostredia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .login-logo {
            max-height: 100px;
            display: block;
            margin: 0 auto 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="login-container">
            <img src="../obrazky/logo.png" alt="Logo" class="login-logo">
            <h3 class="text-center mb-3">Monitoring prostredia</h3>
            <p class="text-center text-muted mb-4">Prosím, prihláste sa pre zobrazenie údajov o prostredí.</p>

            <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Používateľské meno</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Heslo</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Prihlásiť sa</button>
            </form>
        </div>
    </div>
</body>
</html>
