<?php 
session_start();
$pageTitle = 'Přihlášení';
require_once('common.php'); 
include 'template/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; 

    $sql = "SELECT id, firstName, lastName, password, email FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['firstName'];
            $_SESSION['user_email'] = $row['email'];
            
            header("Location: index.php");
            exit();

        } else {
            $errorMsg = "Zadali jste nesprávné heslo.";
        }
    } else {
        $errorMsg = "Uživatel s tímto emailem neexistuje.";
    }
}
?>

<section class="auth-section">
    <div class="auth-card">
        <h2>Přihlášení</h2>
        
        <form method="post">
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="jan@email.cz">
            </div>

            <div class="form-group">
                <label for="password">Heslo</label>
                <input type="password" id="password" name="password" required placeholder="Vaše heslo">
            </div>

            <button type="submit" class="auth-btn">Přihlásit se</button>
        </form>

        <span class="switch-form-link">
            Ještě nemáte účet? <a href="registration.php">Zaregistrovat se</a>
        </span>
    </div>
</section>

<?php include 'template/footer.php'; ?>