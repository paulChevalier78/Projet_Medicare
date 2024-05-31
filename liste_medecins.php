<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Médecins</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>
        .medecin {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        .medecin-photo {
            width: 100px;
            height: 100px;
            margin-right: 10px;
            border-radius: 10px;
        }
        .medecin-details {
            flex: 1;
        }
        .medecin-details h4 {
            margin: 0;
            font-weight: bold;
        }
        .medecin-details p {
            margin: 5px 0;
            font-weight: bold;
        }
        .prendre-rdv-btn {
            margin-left: auto;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
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
        <div class="container">
            <h2>Liste des Médecins</h2>
            <div id="liste-medecins">
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

                // Récupérer la spécialité sélectionnée
                $specialite = $_GET['specialite'];

                // Construire la requête SQL en fonction de la spécialité
                $sql = "SELECT id, nom, prenom, specialite, photo FROM medecins";
                if ($specialite !== "") {
                    $sql .= " WHERE specialite='$specialite'";
                }

                // Exécuter la requête SQL
                $result = $conn->query($sql);

                // Afficher les résultats
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='medecin'>";
                        echo "<img src='" . $row['photo'] . "' alt='Photo de " . $row['nom'] . " " . $row['prenom'] . "' class='medecin-photo'>";
                        echo "<div class='medecin-details'>";
                        echo "<h4>" . $row['nom'] . " " . $row['prenom'] . "</h4>";
                        echo "<p>" . $row['specialite'] . "</p>";
                        echo "</div>";
                        echo "<form action='info.php' method='GET'>";
                        echo "<input type='hidden' name='medecin_id' value='" . $row['id'] . "'>";
                        echo "<button type='submit' class='prendre-rdv-btn'>Prendre Rendez-vous</button>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                    echo "Aucun médecin trouvé pour cette spécialité.";
                }


                // Fermer la connexion à la base de données
                $conn->close();
                ?>
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
