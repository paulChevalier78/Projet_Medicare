<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant que client
if (!isset($_SESSION['patients'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: connexion.php");
    exit();
}

$client = $_SESSION['patients'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Medicare - Accueil Client</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .patient-info-section {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .patient-info-section h2 {
            margin-bottom: 20px;
            color: #50ce11;
        }
        .patient-info-section p {
            margin: 10px 0;
            font-size: 16px;
        }
        .patient-info-section p span {
            font-weight: bold;
            color: #333;
        }
        .custom-button {
            background-color: #4CAF50; /* Couleur de fond */
            border: none; /* Pas de bordure */
            color: white; /* Couleur du texte */
            padding: 15px 30px; /* Espacement intérieur */
            text-align: center; /* Centrer le texte */
            text-decoration: none; /* Pas de soulignement */
            display: inline-block;
            font-size: 16px; /* Taille de police */
            margin: 4px 2px; /* Marge autour du bouton */
            cursor: pointer; /* Curseur de la souris */
            border-radius: 8px; /* Coins arrondis */
        }

.custom-button:hover {
    background-color: #45a049; /* Couleur de fond au survol */
}
    </style>
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
                    <li class="nav-item"><a class="nav-link" href="accueil_client.php">Accueil</a></li>
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
            <div class="patient-info-section">
                <h2>Votre compte</h2>
                <p><span>Nom:</span> <?php echo htmlspecialchars($client['nom']); ?></p>
                <p><span>Prénom:</span> <?php echo htmlspecialchars($client['prenom']); ?></p>
                <p><span>Contact:</span> <?php echo htmlspecialchars($client['contact']); ?></p>
                <p><span>Email:</span> <?php echo htmlspecialchars($client['email']); ?></p>
                <p><span>Numéro de sécurité sociale:</span> <?php echo htmlspecialchars($client['id']); ?></p>
                <button class="custom-button" onclick="window.location.href='mode_paiement.php'">Voir mode de paiement</button>

            </div>

        </div>

        <footer class="page-footer">
            <div class="container">
                <p>&copy; 2019 Copyright | Droit d'auteur: webDynamique.ece.fr</p>
            </div>
        </footer>        
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
