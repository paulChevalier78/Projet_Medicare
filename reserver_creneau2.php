<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "rdv";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si des données ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $medecin_id = $_POST['medecin_id'];
    $date = $_POST['date'];
    $heure_debut = $_POST['heure_debut'];
    $heure_fin = $_POST['heure_fin'];

    // Préparer et exécuter la requête SQL
    $sql = "INSERT INTO disponibilites (medecin_id, date, heure_debut, heure_fin, est_reserve) VALUES ('$medecin_id', '$date', '$heure_debut', '$heure_fin', 0)";

    if ($conn->query($sql) === TRUE) {
        echo "Créneau ajouté avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

// Fermer la connexion
$conn->close();
?>
