<?php
session_start();

// Vérification si l'administrateur est déjà connecté
if (isset($_SESSION['administrateurs']) && $_SESSION['administrateurs'] === true) {
    // Redirection vers la page d'accueil de l'administrateur si déjà connecté
    header("Location: accueil.html");
    exit;
}

// Vérification des informations de connexion de l'administrateur
$admin_nom = "Ratio";
$admin_prenom = "Bozo";
$admin_email = "ratio.bozo@gmail.com";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];

    // Vérification des informations de connexion
    if ($nom === $admin_nom && $prenom === $admin_prenom && $email === $admin_email) {
        // Stockage des informations de l'administrateur dans la session
        $_SESSION['admin'] = true;

        // Redirection vers la page d'accueil de l'administrateur
        header("Location: compte_admin.php");
        exit;
    } else {
        $error_message = "Identifiants invalides. Veuillez réessayer.";
    }
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="recherche.js" defer></script>
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
                    <li class="nav-item"><a class="nav-link" href="accueil_admin.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="tout_parcourir_admin.php">Tout parcourir</a></li>
                    <li class="nav-item"><a class="nav-link" href="compte_admin.php">Votre compte</a></li>
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
            <div class="row align-items-start">
                <div class="col">
                    <a href="liste_medecins_client.php"><h3>Médecine générale</h3></a>
                </div>
                <div class="col">
                <a href="specialite_client.php"><h3>Médecins spécialistes</h3></a>

                </div>
                <div class="col">*
                <a href="LabBioMed_client.html"><h3>Laboratoire de biologie médicale</h3></a>
                </div>
            </div>
        </div>
        <footer class="page-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h6 class="text-uppercase font-weight-bold">Information additionnelle</h6>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque interdum quam odio, quis placerat ante luctus eu. Sed aliquet dolor id sapien rutrum, id vulputate quam iaculis.
                        </p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h6 class="text-uppercase font-weight-bold">Contact</h6>
                        <p>
                            10 Rue Sextius Michel, 75015 Paris, France <br>
                            info@webDynamique.ece.fr <br>
                            +33 01 02 03 04 05 <br>
                            +33 01 03 02 05 04
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="googleMap">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5250.744877226207!2d2.2859626764985514!3d48.85110800121883!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b486bb253%3A0x61e9cc6979f93fae!2s10%20Rue%20Sextius%20Michel%2C%2075015%20Paris!5e0!3m2!1sfr!2sfr!4v1716713668012!5m2!1sfr!2sfr" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copyright text-center">&copy; 2019 Copyright | Droit d'auteur: webDynamique.ece.fr</div>
        </footer>

    </div>
</body>
</html>
