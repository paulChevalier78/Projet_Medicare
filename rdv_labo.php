<?php

// Identifiants de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "rdv";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die(json_encode(array("success" => false, "message" => "Connection failed: " . $conn->connect_error)));
}

// Déterminer l'action à effectuer (get ou save)
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Action pour récupérer les rdvv-vous existants
if ($action == 'get') {
    $sql = "SELECT heure, jour, specialite FROM rdvv";
    $result = $conn->query($sql);

    $rdvs = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rdvs[] = $row;
        }
    }

    echo json_encode(array("success" => true, "rdvs" => $rdvs));
}

// Action pour sauvegarder un nouveau rdvv-vous
elseif ($action == 'save') {
    // Récupérer les données envoyées par AJAX
    $heure = isset($_POST['heure']) ? $_POST['heure'] : '';
    $jour = isset($_POST['jour']) ? $_POST['jour'] : '';
    $specialite = isset($_POST['specialite']) ? $_POST['specialite'] : '';

    if (!$heure || !$jour || !$specialite) {
        die(json_encode(array("success" => false, "message" => "Données manquantes")));
    }

    // Protéger contre les injections SQL
    $heure = $conn->real_escape_string($heure);
    $jour = $conn->real_escape_string($jour);
    $specialite = $conn->real_escape_string($specialite);

    // Vérifier si le rdvv-vous existe déjà pour la même spécialité
    $sql_check = "SELECT * FROM rdvv WHERE heure='$heure' AND jour='$jour' AND specialite='$specialite'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        die(json_encode(array("success" => false, "message" => "Cette plage horaire est déjà réservée pour cette spécialité.")));
    }

    // Enregistrer le nouveau rdvv-vous
    $sql = "INSERT INTO rdvv (heure, jour, specialite) VALUES ('$heure', '$jour', '$specialite')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("success" => true, "message" => "Rendez-vous enregistré avec succès."));
    } else {
        echo json_encode(array("success" => false, "message" => "Erreur lors de l'enregistrement du rendez-vous: " . $conn->error));
    }
}

// Action non reconnue
else {
    echo json_encode(array("success" => false, "message" => "Action non reconnue."));
}

// Fermer la connexion
$conn->close();
?>
