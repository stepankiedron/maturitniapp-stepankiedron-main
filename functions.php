<?php
declare(strict_types=1);

function osetriVstup(string $data, int $maxDelka = 255): string {
    $data = trim($data); // Odstranění bílých znaků na začátku a konci
    $data = stripslashes($data); // Odstranění zpětných lomítek
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // Ochrana proti XSS útokům
    $data = strip_tags($data); // Odstranění HTML tagů
    if (strlen($data) > $maxDelka) { // Ochrana proti dlouhým vstupům
        $data = substr($data, 0, $maxDelka);
    }
    return $data;
}

function jePlatnyEmail(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function osoleneHeslo(string $password): string {
    $salt = 'urWfWwT9KAXuAUH*^w7sH&9@g';
    return $salt . $password . chunk_split($salt, 4 ,".");
}
?>
