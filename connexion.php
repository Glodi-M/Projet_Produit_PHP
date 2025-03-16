<?php

$db_host = 'localhost';
$db_name = 'ge-produits';
$db_user =  'root';
$db_pass = '';


// Connexion à la base de données

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}
