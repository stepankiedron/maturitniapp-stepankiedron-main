<?php 
declare(strict_types=1);
$pageTitle = 'Registrace';
include 'template/header.php'; 
require_once('common.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = isset($_POST['firstName']) ? osetriVstup($_POST['firstName'], 200) : '';
    $lastName = isset($_POST['lastName']) ? osetriVstup($_POST['lastName'], 200) : '';
    $email = isset($_POST['email']) ? osetriVstup($_POST['email'], 200) : '';
    $password = isset($_POST['password']) ? osetriVstup($_POST['password'], 200) : '';

    if (empty($firstName) || empty($lastName) ||empty($email) || empty($password)) {
        echo "Chyba, všechna pole musí být vyplněna.";
    }

    if (!jePlatnyEmail($email)) {
        echo "Chyba, neplatný formát emailu.";
    }

    $firstName = mysqli_real_escape_string($conn, $firstName);
    $lastName = mysqli_real_escape_string($conn, $lastName);
    $email = mysqli_real_escape_string($conn, $email);
    $ulozenyHash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

    $sqlCheck = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
    $resultCheck = mysqli_query($conn, $sqlCheck);
    if (mysqli_num_rows($resultCheck) > 0) {
        echo "Chyba: Uživatel s tímto emailem " . htmlspecialchars($email) . " už je zaregistrován.";
    } else {

    $sql = "INSERT INTO users (firstName, lastName, email, password) VALUES ('$firstName','$lastName', '$email', '$ulozenyHash')";
    
    if (mysqli_query($conn, $sql)) {
    $ID_users = mysqli_insert_id($conn);
    echo "Úspěšně jste se registrovali -" . $firstName;
    header('Location: login.php');
    }   else {
        echo "Chyba: " . mysqli_error($conn);
    }}}

mysqli_close($conn);

?>

<section class="auth-section">
    <div class="auth-card">
        <h2>Vytvořit účet</h2>
        
        <form method="post">
            
            <div class="form-group">
                <label for="firstName">Jméno</label>
                <input type="text" id="firstName" name="firstName" required placeholder="Např. Jan">
            </div>

            <div class="form-group">
                <label for="lastName">Příjmení</label>
                <input type="text" id="lastName" name="lastName" required placeholder="Např. Novák">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="example@email.cz">
            </div>

            <div class="form-group">
                <label for="password">Heslo</label>
                <input type="password" id="password" name="password" required placeholder="Vaše heslo">
            </div>

            <button type="submit" class="auth-btn" href="login.php">Registrovat se</button>
        </form>

        <span class="switch-form-link">
            Už máte účet? <a href="login.php">Přihlásit se</a>
        </span>
    </div>
</section>

<?php include 'template/footer.php'; ?>
 
