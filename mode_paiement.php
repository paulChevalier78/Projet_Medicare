<?php
session_start();

if (!isset($_SESSION['patients'])) {
    header("Location: connexion.php");
    exit();
}

$client = $_SESSION['patients'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte</title>
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
                    <li class="nav-item"><a class="nav-link" href="acceuil_client.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="tout_parcourir_client.php">Tout parcourir</a></li>
                    <li class="nav-item"><a class="nav-link" href="rdv_client.php">Rendez-vous</a></li>
                    <li class="nav-item"><a class="nav-link" href="compte_client.php">Votre compte</a></li>
                    <input type="text" id="searchInput" placeholder="Rechercher..." class="form-control mr-2" aria-label="Search">
                <button class="btn btn-dark btn-sm" type="submit"  onclick="search()" >Rechercher</button>
                </ul>
            </div>
            <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white" href="deconnexion_admin.php">Se déconnecter</a>
                    </li>
                </ul>
        </nav>
        <div id="searchResults"></div>

    <div class="container">
        <h2 class="text-center">Votre Compte</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Informations Personnelles</h5>
                <p class="card-text"><strong>Nom :</strong> <?php echo htmlspecialchars($client['nom']); ?></p>
                <p class="card-text"><strong>Prénom :</strong> <?php echo htmlspecialchars($client['prenom']); ?></p>
                <p class="card-text"><strong>Contact :</strong> <?php echo htmlspecialchars($client['contact']); ?></p>
                <p class="card-text"><strong>Email :</strong> <?php echo htmlspecialchars($client['email']); ?></p>
                <p class="card-text"><strong>Numéro de sécurité sociale :</strong> <?php echo htmlspecialchars($client['id']); ?></p>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Informations de Paiement</h5>
                <p class="card-text"><strong>Adresse Ligne 1 :</strong> <?php echo htmlspecialchars($client['adresse1']); ?></p>
                <p class="card-text"><strong>Adresse Ligne 2 :</strong> <?php echo htmlspecialchars($client['adresse2']); ?></p>
                <p class="card-text"><strong>Ville :</strong> <?php echo htmlspecialchars($client['ville']); ?></p>
                <p class="card-text"><strong>Code Postal :</strong> <?php echo htmlspecialchars($client['code_postal']); ?></p>
                <p class="card-text"><strong>Pays :</strong> <?php echo htmlspecialchars($client['pays']); ?></p>
                <p class="card-text"><strong>Numéro de la carte :</strong> <?php echo htmlspecialchars($client['numero_carte']); ?></p>
                <p class="card-text"><strong>Nom affiché sur la carte :</strong> <?php echo htmlspecialchars($client['nom_carte']); ?></p>
                <p class="card-text"><strong>Date d'expiration :</strong> <?php echo htmlspecialchars($client['date_expiration']); ?></p>
                <p class="card-text"><strong>Code de sécurité :</strong> <?php echo htmlspecialchars($client['code_securite']); ?></p>
            </div>
        </div>
    </div>
</body>
</html>
