<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$game_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
require_once 'common.php'; 

$message = ''; 
$msgType = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_rating'])) {
    
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $rating = intval($_POST['rating']); 
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);
        
        if ($rating >= 1 && $rating <= 5) {
            $sqlInsert = "INSERT INTO ratings (ID_game, ID_users, rating, comment, created) 
                          VALUES ($game_id, $userId, '$rating', '$comment', NOW())";
            
            if (mysqli_query($conn, $sqlInsert)) {
                header("Location: game_detail.php?id=$game_id&msg=rated");
                exit();
            } else {
                $message = "Chyba při ukládání: " . mysqli_error($conn);
                $msgType = 'error';
            }
        } else {
            $message = "Neplatné hodnocení.";
            $msgType = 'error';
        }
    } else {
        $message = "Pro hlasování musíte být přihlášeni.";
        $msgType = 'error';
    }
}

// NAČTENÍ DAT O HŘE

$sql = "SELECT * FROM games WHERE ID = $game_id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $game = mysqli_fetch_assoc($result);
    $pageTitle = $game['title'];
    $pageDesc = $game['description'];
    $pageImg = 'img/' . $game['img']; 
    $releaseYear = $game['releasedate'];
    $devId = $game['ID_dev'];
} else {
    echo "Hra nebyla nalezena."; 
    exit();
}

// NAČTENÍ RECENZÍ

$sqlReviews = "SELECT r.*, u.firstName, u.lastName 
               FROM ratings r 
               JOIN users u ON r.ID_users = u.ID 
               WHERE r.ID_game = $game_id 
               ORDER BY r.created DESC";
$resultReviews = mysqli_query($conn, $sqlReviews);

include 'template/header.php'; 
?>

<section id="game-detail" class="info-section">
    <div class="container">

        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'rated'): ?>
            <div class="alert alert-success">
                Děkujeme! Vaše hodnocení bylo přidáno.
            </div>
        <?php endif; ?>

        <?php if (!empty($message)): ?>
            <div class="alert alert-error">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <h1><?php echo htmlspecialchars($pageTitle); ?></h1>
        
        <div class="detail-content">
            <div class="info-img">
                <img src="<?php echo htmlspecialchars($pageImg); ?>" alt="<?php echo htmlspecialchars($pageTitle); ?>">
            </div>

            <aside class="sidebar">
                <div class="description-section">
                    <h2>Popis hry</h2>
                    <p><?php echo nl2br(htmlspecialchars($pageDesc)); ?></p>
                </div>
                <h3>Technické detaily</h3>
                <ul>
                    <li><strong>Rok vydání:</strong> <?php echo htmlspecialchars($releaseYear); ?></li>
                    <li><strong>Studio ID:</strong> <?php echo htmlspecialchars($devId); ?></li>
                </ul>
            </aside>
        </div>

        <div class="reviews-section">
            <h2>Hodnocení a komentáře</h2>

            <?php if (isset($_SESSION['user_id'])): ?>
                
                <div class="review-form-card">
                    <h3>Přidat recenzi</h3>
                    <form method="post">
                        <div class="form-group">
                            <label for="rating">Hodnocení:</label>
                            <select name="rating" id="rating" required class="review-input">
                                <option value="5">★★★★★ (5 - Vynikající)</option>
                                <option value="4">★★★★☆ (4 - Velmi dobré)</option>
                                <option value="3">★★★☆☆ (3 - Průměrné)</option>
                                <option value="2">★★☆☆☆ (2 - Nic moc)</option>
                                <option value="1">★☆☆☆☆ (1 - Špatné)</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="comment">Váš komentář:</label>
                            <textarea name="comment" id="comment" rows="4" required placeholder="Napište, co se vám líbilo..." class="review-textarea"></textarea>
                        </div>

                        <button type="submit" name="submit_rating" class="button">Odeslat hodnocení</button>
                    </form>
                </div>

            <?php else: ?>
                <div class="login-prompt">
                    <p>Pro přidání hodnocení se musíte <a href="login.php" class="login-link">přihlásit</a>.</p>
                </div>
            <?php endif; ?>

            <div class="reviews-list">
                <?php if (mysqli_num_rows($resultReviews) > 0): ?>
                    
                    <?php while($review = mysqli_fetch_assoc($resultReviews)): ?>
                        <div class="review-card">
                            <div class="review-header">
                                <strong class="review-author">
                                    <?php echo htmlspecialchars($review['firstName'] . ' ' . $review['lastName']); ?>
                                </strong>
                                <span class="review-stars">
                                    <?php 
                                    echo str_repeat('★', intval($review['rating'])); 
                                    echo str_repeat('☆', 5 - intval($review['rating'])); 
                                    ?>
                                </span>
                            </div>
                            
                            <p class="review-text"><?php echo nl2br(htmlspecialchars($review['comment'])); ?></p>
                            
                            <small class="review-date">
                                Přidáno: <?php echo date("d.m.Y H:i", strtotime($review['created'])); ?>
                            </small>
                        </div>
                    <?php endwhile; ?>

                <?php else: ?>
                    <p class="no-reviews">Zatím zde nejsou žádná hodnocení. Buďte první!</p>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

<?php include 'template/footer.php'; ?>