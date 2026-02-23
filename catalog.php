<?php
require_once 'common.php'; 
$pageTitle = 'Katalog her';
include 'template/header.php'; 
$selected_genre_id = isset($_GET['genre_id']) ? intval($_GET['genre_id']) : 0;
?>

<main class="catalog-page">
    <div class="container">
        
        <h1 class="catalog-title">Katalog indie her</h1>

        <div class="filter-wrapper">
            <form method="GET" action="catalog.php" class="filter-form">
                <label for="genre-select">Filtrovat podle žánru:</label>
                
                <select name="genre_id" id="genre-select" class="filter-select" onchange="this.form.submit()">
                    
                    <option value="0" <?php if ($selected_genre_id == 0) echo 'selected'; ?>>Všechny žánry</option>
                    
                    <?php
                   
                    $sqlGenres = "SELECT * FROM genres ORDER BY name ASC";
                    $resultGenres = mysqli_query($conn, $sqlGenres);

                    if ($resultGenres) {
                        while ($rowG = mysqli_fetch_assoc($resultGenres)) {
    
                            $gID = intval($rowG['ID']); 
                            $gName = htmlspecialchars($rowG['name']);
                            
                            if ($selected_genre_id === $gID) {
                                $selectedAttr = 'selected';
                            } else {
                                $selectedAttr = '';
                            }
                            
                            echo "<option value='$gID' $selectedAttr>$gName</option>";
                        }
                    }
                    ?>
                </select>
            </form>
        </div>
        </form>
    </div>

        <div class="games-grid">
            <?php
            $sql = "SELECT games.ID, games.title, games.img FROM games";

            if ($selected_genre_id > 0) {
                $sql .= " JOIN genresgames ON games.ID = genresgames.ID_game";
                $sql .= " WHERE genresgames.ID_genre = $selected_genre_id";
            }

            $sql .= " ORDER BY games.ID ASC"; 
            
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['ID'];
                    $title = htmlspecialchars($row['title']);
                    $imagePath = 'img/' . htmlspecialchars($row['img']);
                    
                    if (empty($row['img']) || !file_exists($imagePath)) {
                        $imagePath = 'img/placeholder.png'; 
                    }
                    ?>

                    <div class="game-card">
                        <a href="game_detail.php?id=<?php echo $id; ?>">
                            <div class="game-image-wrapper">
                                <img src="<?php echo $imagePath; ?>" alt="<?php echo $title; ?>">
                                <div class="game-title-overlay">
                                    <h3><?php echo $title; ?></h3>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php
                }
            } else {
                echo 'Pro tento žánr jsme nenašli žádné hry.';
            }
            ?>
        </div>
    </div>
</main>

<?php 
include 'template/footer.php';
?>