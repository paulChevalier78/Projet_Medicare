<?php
$database = "medicare";

$db_handle = mysqli_connect('localhost', 'root', 'root', $database);

if ($db_handle) {
    $action = !empty($_POST['action']) ? $_POST['action'] : '';

    if ($action == 'ajouter_reservation') {
        if (!empty($_POST['medecin_id']) && !empty($_POST['jour']) && !empty($_POST['heure_debut']) && !empty($_POST['heure_fin'])) {
            $medecinId = (int) $_POST['medecin_id'];
            $jour = mysqli_real_escape_string($db_handle, $_POST['jour']);
            $heureDebut = mysqli_real_escape_string($db_handle, $_POST['heure_debut']);
            $heureFin = mysqli_real_escape_string($db_handle, $_POST['heure_fin']);

            $jour = $_POST['jour']; // Récupération de la date sous forme de chaîne
            $jour_formatte = date('Y-m-d', strtotime(str_replace('/', '-', $jour))); // Formatage de la date

            // Utilisation de $jour_formatte dans votre requête INSERT
            $sql = "INSERT INTO reservations (medecin_id, jour, heure_debut, heure_fin) VALUES ('$medecinId', '$jour_formatte', '$heureDebut', '$heureFin')";

            $result = mysqli_query($db_handle, $sql);

            if ($result) {
                echo "Réservation ajoutée avec succès.";
            } else {
                echo "Erreur lors de l'ajout de la réservation : " . mysqli_error($db_handle) . "";
            }
        } else {
            echo "Tous les champs sont obligatoires pour l'ajout d'une réservation.";
        }
    }

    mysqli_close($db_handle);
} else {
    echo "Base de données non trouvée.";
}
?>
