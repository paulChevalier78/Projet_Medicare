<!DOCTYPE html>
<html>
<head>
    <title>Medicare - Prendre Rendez-vous</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
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
                <li class="nav-item"><a class="nav-link" href="tout_parcourir.php">Tout parcourir</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Rendez-vous</a></li>
                <li class="nav-item"><a class="nav-link" href="connexion.php">Se connecter</a></li>
                <input type="text" id="searchInput" placeholder="Rechercher..." class="form-control mr-2" aria-label="Search">
                <button class="btn btn-dark btn-sm" type="submit"  onclick="search()" >Rechercher</button>
            </ul>
        </div>
    </nav>     
    
    <div id="searchResults"></div>

        <div class="container mt-5">
            <?php
            // Connexion à la base de données
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "rdv";

            // Création de la connexion
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Vérifier la connexion
            if ($conn->connect_error) {
                die("La connexion à la base de données a échoué : " . $conn->connect_error);
            }

            // Récupérer l'ID du médecin
            $medecin_id = $_GET['medecin_id'];

            // Construire la requête SQL pour récupérer les informations du médecin
            $sql = "SELECT * FROM medecins WHERE id='$medecin_id'";

            // Exécuter la requête SQL
            $result = $conn->query($sql);

                        
            // Afficher les informations du médecin
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<div class='row'>";
                echo "<div class='col-md-4 text-center'>";
                echo "<img src='" . $row['photo'] . "' alt='Photo du Docteur " . $row['nom'] . "' class='img-fluid mb-3'>";
                echo "<div>";
                echo "<p><strong>Nom :</strong> " . $row['nom'] . "</p>";
                echo "<p><strong>Prénom :</strong> " . $row['prenom'] . "</p>";
                echo "<p><strong>Spécialité :</strong> " . $row['specialite'] . "</p>";
                echo "<p><strong>Téléphone :</strong> " . $row['contact'] . "</p>";
                echo "<p><strong>E-mail :</strong> " . $row['email'] . "</p>";
                echo "</div>";

                // Bouton pour voir les disponibilités (en vert et légèrement plus gros)
                echo "<form class='text-center' action='connexion.php' method='GET'>";
                echo "<input type='hidden' name='medecin_id' value='" . $row['id'] . "'>";
                echo "<button type='submit' class='btn btn-success btn-lg mt-3'>Prendre rendez-vous</button>";
                echo "</form>";

                echo "</div>";
                echo "<div class='col-md-8'>";
                echo "<h1>Dr. " . $row['nom'] . " " . $row['prenom'] . "</h1>";
                echo "<p><strong>Adresse :</strong> " . $row['adresse'] . "</p>";
                echo "<div class='googleMap mb-3'>";
                echo "<iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2623.821127498114!2d2.347294915678305!3d48.858487179284516!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e2f2f6e7f5f%3A0x86f1c72aa3c5e3c3!2s14%20Rue%20de%20la%20Ferronnerie%2C%2075011%20Paris' width='100%' height='300' style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe>                    </div>";
                echo "</div>";
                echo "</div>";
            } else {
                echo "Aucun médecin trouvé.";
            }
            ?>

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

