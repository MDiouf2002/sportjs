<?php
include 'includes/function.php';  


if (!databaseExists()) {
    
    echo '<p>Base de données introuvable. Cliquer <a href="scripts/init.php">here</a> pour initialiser la base de données. 😁</p>';
} else {
    
    header("Location: public/index.php");
    exit();
}
?>
