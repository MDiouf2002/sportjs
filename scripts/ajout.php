<?php
include '../includes/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prenom = getFied('prenom');
    $nom = getFied('nom');
    $depart = getFied('depart');
    $mail = getFied('mail');
    $sport_id = getFied('sport_id');
    $niveau = getFied('niveau');

    $personne_id = getPersonIdByEmail($mail, $mysqli);

    if ($personne_id) {

        $pratiqueExist = $mysqli->query("SELECT * FROM pratique WHERE personne_id = '$personne_id' AND sport_id = '$sport_id'");

        if ($pratiqueExist->num_rows > 0) {
            $queryPratique = "UPDATE pratique SET niveau = '$niveau' WHERE personne_id = '$personne_id' AND sport_id = '$sport_id'";

            $log="Mise à jour pratique";//For Debuging
        } else {
            $queryPratique = "INSERT INTO pratique (personne_id, sport_id, niveau) VALUES ('$personne_id', '$sport_id', '$niveau')";
            $log = "Creation d'une pratique";//For Debuging
        }

        if ($mysqli->query($queryPratique)) {
            $log.=" avec succés!";//For Debuging 
            // print($log);//For Debuging
            setAlert($log);
            header("Location: ../public/index.php");
            exit();
        } else {
            $log.="Echec !<br>Erreur: " . $mysqli->error;
            print($log);//For Debuging
            setAlert($log,'danger');
        }
    } else {
        if (insertUser($prenom, $nom, $depart, $mail, $sport_id, $niveau, $mysqli)) {
            setcookie('user_email', $mail, time() + 3600, '/'); 
            $idUser = getPersonIdByEmail($mail, $mysqli);
            $log = "Utilisateur ajouté et connecté. Avec l'identifiant USR-".$idUser;//For Debuging
            // print($log);//For Debuging
            setAlert($log);
            header("Location: ../public/index.php");
            exit();
        } else {
            $log = "Erreur lors de création de l'utilisateur";//For Debuging
            setAlert($log);
        }
    }
}
?>
