<?php
// Paramètres de connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "root";
$base_de_donnees = "rdv";

// Liste des administrateurs
$administrateurs = array(
    array("nom" => "Ratio", "prenom" => "Bozo", "email" => "ratio.bozo@gmail.com")
);

try {
    // Connexion à la base de données avec PDO
    $connexion = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $mot_de_passe);

    // Définition de l'attribut PDO pour afficher les erreurs SQL
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si les paramètres POST ont été envoyés
    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email'])){
        // Récupérer les valeurs des paramètres POST
        $nomUtilisateur = $_POST['nom'];
        $prenomUtilisateur = $_POST['prenom'];
        $emailUtilisateur = $_POST['email'];

        // Requête SQL pour rechercher l'utilisateur dans la table medecins
        $requete_medecin = $connexion->prepare("SELECT * FROM medecins WHERE nom = :nom AND prenom = :prenom AND email = :email");
        $requete_medecin->bindParam(':nom', $nomUtilisateur);
        $requete_medecin->bindParam(':prenom', $prenomUtilisateur);
        $requete_medecin->bindParam(':email', $emailUtilisateur);
        $requete_medecin->execute();
        $medecin = $requete_medecin->fetch(PDO::FETCH_ASSOC);

        // Vérifier si un médecin correspondant a été trouvé
        if($medecin){
            // Si l'utilisateur est un médecin, retourner un message de succès
            echo 'success: medecin';
            exit; // Assure que le script s'arrête ici
        }

        // Parcourir la liste des administrateurs pour l'authentification
        foreach($administrateurs as $administrateur){
            if($administrateur['nom'] == $nomUtilisateur && $administrateur['prenom'] == $prenomUtilisateur && $administrateur['email'] == $emailUtilisateur){
                // Si l'utilisateur est l'administrateur, retourner un message de succès
                echo 'success: administrateur';
                exit; // Assure que le script s'arrête ici
            }
        }
    }

    // Si les informations de connexion ne correspondent à aucun utilisateur, retourner une erreur
    echo 'error: informations de connexion incorrectes';
} catch(PDOException $e) {
    // En cas d'erreur lors de la connexion à la base de données, afficher l'erreur
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
