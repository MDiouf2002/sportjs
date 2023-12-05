<?php
include '../includes/function.php';
setcookie('user_email', '', time() - 9999999, '/');  //Pour tester je le mets à 600s
$log = "Utilisateur déconnecté avec succéss";
setAlert($log);
header("Location: ../public/index.php");
?>