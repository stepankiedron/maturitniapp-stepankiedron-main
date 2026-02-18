<?php 
$pageTitle = 'Přihlášení';
include 'template/header.php'; 
?>

<section class="auth-section">
    <div class="auth-card">
        <h2>Přihlášení</h2>
        
        <form action="check_login.php" method="post">
            
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