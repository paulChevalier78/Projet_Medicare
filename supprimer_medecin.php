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
                    <li class="nav-item"><a class="nav-link" href="acceuil.html">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Tout parcourir</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Recherche</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Rendez-vous</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Votre compte</a></li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row align-items-start">
                <div class="col">
                    <h3>Supprimer un médecin</h3>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="id">ID du Médecin</label>
                            <input type="text" class="form-control" id="id" name="id" required>
                        </div>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>

                    <?php
                    // Configuration de la base de données
                    $servername = "localhost";
                    $username = "root";
                    $password = "root";
                    $dbname = "rdv";

                    // Créer une connexion
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Vérifier la connexion
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Définir le message par défaut
                    $message = "";

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $id = intval($_POST["id"]);

                        // Préparer et exécuter la requête de suppression
                        $sql = "DELETE FROM medecins WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $id);
                        if ($stmt->execute()) {
                            $message = "Le médecin a été supprimé avec succès.";
                        } else {
                            $message = "Aucun médecin trouvé avec cet ID.";
                        }

                        $stmt->close();
                    }

                    $conn->close();
                    ?>

                    <!-- Afficher le message -->
                    <div><?php echo $message; ?></div>
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