<?php
// rdv.php

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "rdv";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des données du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $medecin_id = $_POST['medecin_id'];
    $date = $_POST['date'];
    $heure_debut = $_POST['heure_debut'];
    $heure_fin = $_POST['heure_fin'];

    // Vérifier si le créneau est déjà réservé
    $check_sql = "SELECT * FROM disponibilites WHERE medecin_id = '$medecin_id' AND date = '$date' AND heure_debut = '$heure_debut' AND heure_fin = '$heure_fin'";
    $result = $conn->query($check_sql);
    if ($result->num_rows > 0) {
        echo "Ce créneau est déjà réservé.";
    } else {
        // Requête d'insertion dans la table disponibilites
        $insert_sql = "INSERT INTO disponibilites (medecin_id, date, heure_debut, heure_fin, est_reserve) 
                VALUES ('$medecin_id', '$date', '$heure_debut', '$heure_fin', 1)";

        // Exécution de la requête
        if ($conn->query($insert_sql) === TRUE) {
            // Ajout du rendez-vous dans la table "rendezvous"
            $insert_rdv_sql = "INSERT INTO rendezvous (medecin_id, date_rendezvous, heure_debut, heure_fin) 
                            VALUES ('$medecin_id', '$date', '$heure_debut', '$heure_fin')";
            if ($conn->query($insert_rdv_sql) === TRUE) {
                echo "Créneau réservé avec succès et rendez-vous ajouté.";
            } else {
                echo "Erreur lors de l'ajout du rendez-vous : " . $conn->error;
            }
        }
    }
}

// Fermeture de la connexion
$conn->close();

?>
