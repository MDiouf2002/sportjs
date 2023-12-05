<?php
include '../includes/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $design = getFied('design');

    if ($design) {
        $query = "INSERT INTO sport (design) VALUES ('$design')";
        if ($mysqli->query($query)) {
            $msg = "Sport added successfully!";
            setAlert($msg);
            header("Location: ../public/ajout.php");

        } else {
            $msg = "Error adding sport: " . $mysqli->error;
            setAlert($msg,'danger');
            header("Location: ../public/ajout.php");

        }
    } else {
        $msg = "Sport name cannot be empty!";
        setAlert($msg,'danger');
        header("Location: ../public/ajout.php");

    }
}
?>
