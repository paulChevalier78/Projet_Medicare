<!DOCTYPE html>
<html>
<head>
    <title>Détails du Médecin</title>
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
            <a href="#"><img src="logo.png" alt="Logo" class="header-logo"></a>
        </header>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main-navigation">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.html">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="generalistes.html">Médecine générale</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Recherche</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Rendez-vous</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Votre compte</a></li>
                </ul>
            </div>
        </nav>

        <div class="container mt-5">
            <?php
            // Médecin spécifique
            $medecin = [
                "nom" => "Dupont",
                "prenom" => "Jean",
                "photo" => "medecin1.png",
                "cv" => "cvmedecin1.png",
                "bureau" => "25 Rue Pierre Demours, 75017 Paris"
            ];
            ?>
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="<?php echo $medecin['photo']; ?>" alt="Photo de <?php echo $medecin['prenom'] . ' ' . $medecin['nom']; ?>" class="img-fluid mb-3">
                    <a href="<?php echo $medecin['cv']; ?>" target="_blank"><img src="<?php echo $medecin['cv']; ?>" alt="CV de <?php echo $medecin['prenom'] . ' ' . $medecin['nom']; ?>" class="img-fluid"></a>
                </div>
                <div class="col-md-8">
                    <h1><?php echo $medecin['prenom'] . ' ' . $medecin['nom']; ?></h1>
                    <p><strong>Bureau :</strong> <?php echo $medecin['bureau']; ?></p>
                    <div class="googleMap mb-3">
                        <!-- Ajoutez ici une carte Google Maps si nécessaire -->
                    </div>
                    <p>Autres informations sur le médecin...</p>
                </div>
            </div>
        </div>

        <footer class="page-footer bg-dark text-white mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h6 class="text-uppercase font-weight-bold">Information additionnelle</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque interdum quam odio, quis placerat ante luctus eu. Sed aliquet dolor id sapien rutrum, id vulputate quam iaculis.</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h6 class="text-uppercase font-weight-bold">Contact</h6>
                        <p>37, quai de Grenelle, 75015 Paris, France <br> info@webDynamique.ece.fr <br> +33 01 02 03 04 05 <br> +33 01 03 02 05 04</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="googleMap">
                            <!-- Ajoutez ici une carte Google Maps si nécessaire -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center py-3">&copy; 2019 Copyright | Droit d'auteur: webDynamique.ece.fr</div>
        </footer>
    </div>
</body>
</html>
