<?php

// Identifiants de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rdv";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die(json_encode(array("success" => false, "message" => "Connection failed: " . $conn->connect_error)));
}

// Déterminer l'action à effectuer (get ou save)
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Action pour sauvegarder un nouveau rendez-vous
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

    // Début de la transaction
    $conn->begin_transaction();

    try {
        // Vérifier si le rendez-vous existe déjà pour la même spécialité
        $sql_check = "SELECT * FROM rendezvous WHERE heure='$heure' AND jour='$jour' AND specialite='$specialite' FOR UPDATE";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            throw new Exception("Cette plage horaire est déjà réservée pour cette spécialité.");
        }

        // Enregistrer le nouveau rendez-vous
        $sql = "INSERT INTO rendezvous (heure, jour, specialite) VALUES ('$heure', '$jour', '$specialite')";
        if ($conn->query($sql) !== TRUE) {
            throw new Exception("Erreur lors de l'enregistrement du rendez-vous: " . $conn->error);
        }

        // Valider la transaction
        $conn->commit();

        echo json_encode(array("success" => true, "message" => "Rendez-vous enregistré avec succès."));
    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $conn->rollback();

        echo json_encode(array("success" => false, "message" => $e->getMessage()));
    }
}


// Action non reconnue
else {
    echo json_encode(array("success" => false, "message" => "Action non reconnue."));
}

// Fermer la connexion
$conn->close();
?>
