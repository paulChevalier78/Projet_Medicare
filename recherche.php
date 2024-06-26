<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root"; // Remplace username par ton nom d'utilisateur de la base de données
$password = "root"; // Remplace password par ton mot de passe de la base de données
$dbname = "rdv";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Vérifier si la requête de recherche a été envoyée
if(isset($_POST['query'])) {
    $searchQuery = $_POST['query'];

    // Requête SQL pour rechercher les médecins correspondant à la recherche
    $sql = "SELECT * FROM medecins WHERE 
        id = '$searchQuery' OR 
        nom LIKE '%$searchQuery%' OR 
        prenom LIKE '%$searchQuery%' OR 
        specialite LIKE '%$searchQuery%' OR 
        contact LIKE '%$searchQuery%' OR 
        email LIKE '%$searchQuery%'";

    $result = $conn->query($sql);

    // Afficher les résultats de la recherche
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Créer un lien vers une page de profil, par exemple en utilisant l'ID du médecin
            $profileLink = "medecing1.html?id=" . $row["id"];
            echo "<p>Nom: <a href='$profileLink'>" . $row["nom"] . " " . $row["prenom"] . "</a>, Spécialité: " . $row["specialite"] . "</p>";
        }
    } else {
        echo "Aucun résultat trouvé.";
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>
