<?php

include '../includes/function.php';
 
$host = "localhost";  
$username = "root";    
$password = "";        
$database = "sports";  

$mysqli = new mysqli($host, $username, $password);

if (!databaseExists()) {
    $sql = file_get_contents('../databases/db.sql'); 
    if ($mysqli->multi_query($sql)) {
        echo "Tables crées et données insérés.";
        echo `<a href="../index.php">Aller à la page d'accueil</a>`;
    } else {
        echo "Erreur d'execution du script: " . $mysqli->error;
    }
    $mysqli->close(); 
}

echo "<a href='../index.php'>Aller à la page d'accueil</a>";





