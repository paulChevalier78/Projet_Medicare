<?php
$servername = "localhost";
$username = "root";  // Par défaut, l'utilisateur MySQL de WAMP est "root"
$password = "";      // Par défaut, il n'y a pas de mot de passe pour "root"
$dbname = "rdv";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}
echo "Connexion réussie!";
?>
