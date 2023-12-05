<?php
    
    include '../includes/conn.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $mail = getFied('mail');

        if (getPersonIdByEmail($mail, $mysqli)) {

            // setcookie('user_email', $mail, time() + 60, '/');  //Pour tester je le mets à 60s
            setcookie('user_email', $mail, time() + 600, '/');  //Pour tester je le mets à 600s
            $log = "Utilisateur connecté avec succéss";
            setAlert($log);
            header("Location: ../public/index.php");
            exit();

        } else {
            $log = "Utilisateur non trouver! Veuillez vous inscrire";
            setAlert($log,'warning');
            header("Location: ../public/ajout.php");
            exit();
        }
    }
?>