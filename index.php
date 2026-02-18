<?php
$pageTitle = 'Katalog Indie Her';
include 'template/header.php'; 
?>

<section id="uvod" class="hero-section">
    <div class="container hero-content">
        <h1>Katalog indie her</h1>
        <p class="popisek">
            Najdete zde skoro každou indie hru, kterou hledáte!
            Hodnocení máme z oficiálních stránek Steamu.
            Tato stránka slouží pouze jako katalog nikoliv jako internetový obchod 
            - hry si můžete zakoupit na oficiálních stránkách vývojářů nebo na platformách jako 
            <a href="https://store.steampowered.com/">Steam</a>, 
            <a href="https://www.gog.com/en/">GOG</a> či 
            <a href="https://itch.io/">Itch.io</a>.
        </p>
    </div>
</section>

<section id="video-section">
    <div class="container-video">
        <video controls> 
            <source src='img/video/03-MATURITA.mp4' type=video/mp4>
        </video>
    </div>
</section>
<?php 
include 'template/footer.php';
?>