<?php
$servername = "localhost"; // Adresse du serveur MySQL
$username = "root"; // Nom d'utilisateur MySQL
$password = "root"; // Mot de passe MySQL
$dbname = "medicare"; // Nom de la base de données

// Créer une connexion
$connexion = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion : " . $connexion->connect_error);
}

$connexion->set_charset("utf8"); // Assurez-vous que la connexion utilise l'encodage UTF-8
?>
