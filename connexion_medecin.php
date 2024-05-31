<?php
session_start(); // Démarrer la session

// Paramètres de connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "root";
$base_de_donnees = "rdv";

$message = ""; // Initialisation du message de connexion

try {
    // Connexion à la base de données avec PDO
    $connexion = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $mot_de_passe);

    // Définition de l'attribut PDO pour afficher les erreurs SQL
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si les paramètres POST ont été envoyés
    if(isset($_POST['username']) && isset($_POST['password'])){
        // Récupérer les valeurs des paramètres POST
        $nomUtilisateur = $_POST['username'];
        $mdp = $_POST['password'];

        // Requête SQL pour rechercher l'utilisateur dans la table patients
        $requete_client = $connexion->prepare("SELECT * FROM medecins WHERE email = :email AND mdp = :mdp");
        $requete_client->bindParam(':email', $nomUtilisateur);
        $requete_client->bindParam(':mdp', $mdp);
        $requete_client->execute();
        $client = $requete_client->fetch(PDO::FETCH_ASSOC);

        // Vérifier si un client correspondant a été trouvé
        if($client){
            // Si l'utilisateur est un client, stocker les informations dans la session et rediriger vers la page d'accueil
            $_SESSION['medecins'] = $client;
            header("Location: accueil_medecin.php");
            exit(); // Assurer que le script s'arrête après la redirection
        } else {
            // Si les informations de connexion ne correspondent à aucun client, retourner une erreur
            $message = 'Identifiant ou mot de passe incorrect.';
        }
    }
} catch(PDOException $e) {
    // En cas d'erreur lors de la connexion à la base de données, afficher l'erreur
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Medicare</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <header class="site-header">
            <a href="#"><img src="loog.png" alt="Logo" class="header-logo"></a>
        </header>
        
        <nav class="navbar navbar-expand-md">
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main-navigation">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="toutParcourir.html">Tout parcourir</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Recherche</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Rendez-vous</a></li>
                    <li class="nav-item"><a class="nav-link" href="connexion.php">Se connecter</a></li>
                </ul>
            </div>
        </nav>

        <div class="container d-flex justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Connexion</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="username">Adresse Email</label>
                        <input type="email" class="form-control" id="username" name="username" placeholder="Adresse Email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Valider</button>
                </form>
                <p class="text-center mt-3"><?php echo $message; ?></p>
                <p class="text-center mt-3">Vous n'avez pas de compte ? <a href="inscription.php">S'inscrire</a></p>
            </div>
        </div>

        <footer class="page-footer">
            <!-- Votre pied de page ici -->
        </footer>        
    </div>
</body>
</html>
