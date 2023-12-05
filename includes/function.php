<?php

session_start();


function databaseExists($database = 'sportifs')
{
    $mysqli = new mysqli("localhost", "root", "");
    $result = $mysqli->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$database'");
    return $result->num_rows > 0;
}

function getFied($field, $method = 'POST')
{
    if ($method == 'POST') {
        $input = $_POST[$field];
    } elseif ($method == 'GET') {
        $input = $_GET[$field];
    }
    return isset($input) && !empty(trim($input)) ? $input : NULL;
}

function isFieldExist($conn, $value, $field, $table, $condition = '=')
{
    $query = "SELECT * FROM $table WHERE $field $condition '$value'";
    $result = $conn->query($query);
    if ($result) {
        return $result;
    } else {
        return false;
    }
}


function getPersonIdByEmail($mail, $mysqli)
{
    $personne = isFieldExist($conn = $mysqli, $value = $mail, $field = 'mail', $table = 'personne');
    // echo $personne;
    if ($personne) {
        $row = $personne->fetch_assoc();
        // echo var_dump($row);
        return $row['personne_id'];
    }
    return false;
}

function getActiveUser($mysqli)
{
    $mail = $_COOKIE["user_email"] ?? '';
    $personne = isFieldExist($conn = $mysqli, $value = $mail, $field = 'mail', $table = 'personne');


    if ($personne) {
        $row = $personne->fetch_assoc();
        return $row;
    }

    return false;
}

function insertUser($prenom, $nom, $depart, $mail, $sport_id, $niveau, $mysqli)
{
    $query = "INSERT INTO personne (prenom, nom, depart, mail) 
              VALUES ('$prenom', '$nom', '$depart', '$mail')";

    if ($mysqli->query($query)) {
        $personne_id = $mysqli->insert_id;

        $queryPratique = "INSERT INTO pratique (personne_id, sport_id, niveau) 
                          VALUES ('$personne_id', '$sport_id', '$niveau')";

        return $mysqli->query($queryPratique);
    }

    return false;
}



function userGreating($user)
{
    if ($user) {
        return "Bienvenue, " . $user['prenom'] . " " . $user['nom'];
    }
    return 'Bienvenue Mr/Mme L\'invité(e)';
}



//Bonus 
function setAlert($message, $type = 'success')
{
    $_SESSION['flash_message'] = [
        'message' => $message,
        'type' => $type,
    ];
}

function showAlert()
{
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message']['message'];
        $type = $_SESSION['flash_message']['type'];
        echo '<div class="my-0 alert alert-' . $type . '">' . $message . '</div>';
        unset($_SESSION['flash_message']);
    }
}
