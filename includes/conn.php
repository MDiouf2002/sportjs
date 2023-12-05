<?php

include_once 'function.php';
 
$host = "localhost";  
$username = "root";    
$password = "";        
$database = "sportifs";  

$mysqli = new mysqli($host, $username, $password,$database);

if ($mysqli->connect_error) {
    echo("Connection failed: " . $mysqli->connect_error);
}

$mysqli->set_charset("utf8");
