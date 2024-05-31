<?php
// Paramètres de connexion à la base de données
$servername = "localhost"; // Remplacez localhost par le nom du serveur si nécessaire
$username = "root"; // Remplacez par votre nom d'utilisateur de la base de données
$password = "root"; // Remplacez par votre mot de passe de la base de données
$dbname = "rdv"; // Nom de votre base de données

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Définition du jeu de caractères à utiliser
mysqli_set_charset($conn, "utf8");

// Pour éviter les problèmes de fuseau horaire
date_default_timezone_set('Europe/Paris');

// Vous pouvez utiliser cette connexion dans d'autres scripts PHP en incluant ce fichier.
?>
