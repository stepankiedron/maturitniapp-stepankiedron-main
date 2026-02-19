<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html><!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Katalog Her'; ?> | </title> 
    
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="main-header">
    <div class="container navbar-content">
        <div class="logo">
            <a href="index.php" class="Logo">
                <img src="img/LOGO1.svg" alt="IndieHub">
            </a>
        </div>

        <div class="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        
        <nav class="main-nav">
            <a href="index.php">Domů</a>
            <a href="catalog.php">Katalog</a>
            <a href="infogames.php">Co to jsou indie hry</a>
            <a href="Top.php">Top 10</a>
            <a href="FAQ.php">FAQ</a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php" class="nav-logout-btn"><span class="nav-user"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span> (Odhlásit se)</a>
            <?php else: ?>
                <a href="registration.php">Registrace</a>
                <a href="login.php">Přihlášení</a> 
            <?php endif; ?>
        </nav>

    </div>
</header>

<main>