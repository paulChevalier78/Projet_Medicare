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
    <script src="script.js" defer></script>
    

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
                    <li class="nav-item"><a class="nav-link" href="acceuil.html">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Tout parcourir</a></li>
                    <li class="nav-item"><a class="nav-link" href="connexion.php">Se connecter</a></li>
                    <input type="text" id="searchInput" placeholder="Rechercher..." class="form-control mr-2" aria-label="Search">
                    <button class="btn btn-dark btn-sm" type="submit" onclick="search()">Rechercher</button>
                </ul>
            </div>
        </nav>

        <div id="searchResults"></div>

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="specialiste.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Médecine spécialiste</h5>
                            <p class="card-text">Trouvez un médecin spécialiste de santé publique (ou un professionnel pratiquant des actes de santé publique et médecine sociale) et réservez en ligne .</p>
                            <a href="specialiste.php" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="general.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Médecins géneralistes</h5>
                            <p class="card-text">Trouvez rapidement un médecin généraliste près de chez vous ou un praticien pratiquant des actes de médecine générale et prenez rendez-vous gratuitement en ligne.</p>
                            <a href="#" onclick="afficherMedecins('Généraliste')" class="btn btn-primary">Voir plus</a>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="labo.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Laboratoires de biologie médicale</h5>
                            <p class="card-text">Trouvez un laboratoire d'analyse médicale et réservez en ligne.</p>
                            <a href="LabBioMed.html" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="page-footer mt-4">
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
