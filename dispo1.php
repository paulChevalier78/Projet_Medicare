<?php
// rdv.php

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "rdv";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des données du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $medecin_id = $_POST['medecin_id'];
    $date = $_POST['date'];
    $heure_debut = $_POST['heure_debut'];
    $heure_fin = $_POST['heure_fin'];

    // Vérifier si le créneau est déjà réservé
    $check_sql = "SELECT * FROM disponibilites WHERE medecin_id = '$medecin_id' AND date = '$date' AND heure_debut = '$heure_debut' AND heure_fin = '$heure_fin'";
    $result = $conn->query($check_sql);
    if ($result->num_rows > 0) {
        echo "Ce créneau est déjà réservé.";
    } else {
        // Requête d'insertion dans la table disponibilites
        $insert_sql = "INSERT INTO disponibilites (medecin_id, date, heure_debut, heure_fin, est_reserve) 
                VALUES ('$medecin_id', '$date', '$heure_debut', '$heure_fin', 1)";

        // Exécution de la requête
        if ($conn->query($insert_sql) === TRUE) {
            echo "Créneau réservé avec succès.";

            // Vérification des données insérées dans la base de données
            $check_insert_sql = "SELECT * FROM disponibilites WHERE medecin_id = '$medecin_id' AND date = '$date' AND heure_debut = '$heure_debut' AND heure_fin = '$heure_fin' AND est_reserve = 1";
            $result_insert = $conn->query($check_insert_sql);
            if ($result_insert->num_rows === 0) {
                echo "Erreur : Les données insérées ne correspondent pas à celles de la base de données.";
            }
        } else {
            echo "Erreur lors de la réservation du créneau : " . $conn->error;
        }
    }
}

// Fermeture de la connexion
$conn->close();

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="recherche.js"></script>
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
                    <li class="nav-item"><a class="nav-link" href="#">Rendez-vous</a></li>
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

        <div id="disponibilites">
        <div class="container mt-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="table-primary" colspan="1" rowspan="2">Spécialité</th>
                        <th class="table-primary" colspan="1" rowspan="2">Médecin</th>
                        <th class="table-success" colspan="2" rowspan="1">Lundi</th>
                        <th class="table-success" colspan="2" rowspan="1">Mardi</th>
                        <th class="table-success" colspan="2" rowspan="1">Mercredi</th>
                        <th class="table-success" colspan="2" rowspan="1">Jeudi</th>
                        <th class="table-success" colspan="1" rowspan="1">Vendredi</th>
                    </tr>
                    <tr>
                        <td colspan="2" class="table-warning">PM</td>
                        <td class="table-danger"><b>AM</b></td>
                        <td class="table-warning"><b>PM</b></td>
                        <td class="table-danger"><b>AM</b></td>
                        <td class="table-warning"><b>PM</b></td>
                        <td class="table-danger"><b>AM</b></td>
                        <td class="table-warning"><b>PM</b></td>
                        <td class="table-danger"><b>AM</b></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="13">Médecin généraliste</td>
                        <td rowspan="13" data-medecin-id="27">Julia Molinari</td>
                        <td colspan="2" data-medecin-id="27" data-jour="2024-06-03" data-heure-debut="14:00:00" data-heure-fin="14:30:00">14:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-04" data-heure-debut="08:00:00" data-heure-fin="08:30:00">08:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-04" data-heure-debut="14:00:00" data-heure-fin="14:30:00">14:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-05" data-heure-debut="08:00:00" data-heure-fin="08:30:00">08:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-05" data-heure-debut="14:00:00" data-heure-fin="14:30:00">14:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-06" data-heure-debut="08:00:00" data-heure-fin="08:30:00">08:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-06" data-heure-debut="14:00:00" data-heure-fin="14:30:00">14:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-07" data-heure-debut="08:00:00" data-heure-fin="08:30:00">08:00</td>
                    </tr>
                    <tr>
                        <td colspan="2" data-medecin-id="27" data-jour="2024-06-03" data-heure-debut="14:30:00" data-heure-fin="15:00:00">14:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-04" data-heure-debut="08:30:00" data-heure-fin="09:00:00">08:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-04" data-heure-debut="14:30:00" data-heure-fin="15:00:00">14:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-05" data-heure-debut="08:30:00" data-heure-fin="09:00:00">08:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-05" data-heure-debut="14:30:00" data-heure-fin="15:00:00">14:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-06" data-heure-debut="08:30:00" data-heure-fin="09:00:00">08:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-06" data-heure-debut="14:30:00" data-heure-fin="15:00:00">14:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-07" data-heure-debut="08:30:00" data-heure-fin="09:00:00">08:30</td>
                    </tr>
                    <tr>
                        <td colspan="2" data-medecin-id="27" data-jour="2024-06-03" data-heure-debut="15:00:00" data-heure-fin="15:30:00">15:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-04" data-heure-debut="09:00:00" data-heure-fin="09:30:00">09:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-04" data-heure-debut="15:00:00" data-heure-fin="15:30:00">15:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-05" data-heure-debut="09:00:00" data-heure-fin="09:30:00">09:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-05" data-heure-debut="15:00:00" data-heure-fin="15:30:00">15:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-06" data-heure-debut="09:00:00" data-heure-fin="09:30:00">09:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-06" data-heure-debut="15:00:00" data-heure-fin="15:30:00">15:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-07" data-heure-debut="09:00:00" data-heure-fin="09:30:00">09:00</td>
                    </tr>
                    <tr>
                        <td colspan="2" data-medecin-id="27" data-jour="2024-06-03" data-heure-debut="15:30:00" data-heure-fin="16:00:00">15:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-04" data-heure-debut="09:30:00" data-heure-fin="10:00:00">09:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-04" data-heure-debut="15:30:00" data-heure-fin="16:00:00">15:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-05" data-heure-debut="09:30:00" data-heure-fin="10:00:00">09:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-05" data-heure-debut="15:30:00" data-heure-fin="16:00:00">15:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-06" data-heure-debut="09:30:00" data-heure-fin="10:00:00">09:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-06" data-heure-debut="15:30:00" data-heure-fin="16:00:00">15:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-07" data-heure-debut="09:30:00" data-heure-fin="10:00:00">09:30</td>
                    </tr>
                    <tr>
                        <td colspan="2" data-medecin-id="27" data-jour="2024-06-03" data-heure-debut="16:00:00" data-heure-fin="16:30:00">16:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-04" data-heure-debut="10:00:00" data-heure-fin="10:30:00">10:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-04" data-heure-debut="16:00:00" data-heure-fin="16:30:00">16:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-05" data-heure-debut="10:00:00" data-heure-fin="10:30:00">10:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-05" data-heure-debut="16:00:00" data-heure-fin="16:30:00">16:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-06" data-heure-debut="10:00:00" data-heure-fin="10:30:00">10:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-06" data-heure-debut="16:00:00" data-heure-fin="16:30:00">16:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-07" data-heure-debut="10:00:00" data-heure-fin="10:30:00">10:00</td>
                    </tr>
                    <tr>
                        <td colspan="2" data-medecin-id="27" data-jour="2024-06-03" data-heure-debut="16:30:00" data-heure-fin="17:00:00">16:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-04" data-heure-debut="10:30:00" data-heure-fin="11:00:00">10:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-04" data-heure-debut="16:30:00" data-heure-fin="17:00:00">16:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-05" data-heure-debut="10:30:00" data-heure-fin="11:00:00">10:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-05" data-heure-debut="16:30:00" data-heure-fin="17:00:00">16:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-06" data-heure-debut="10:30:00" data-heure-fin="11:00:00">10:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-06" data-heure-debut="16:30:00" data-heure-fin="17:00:00">16:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-07" data-heure-debut="10:30:00" data-heure-fin="11:00:00">10:30</td>
                    </tr>
                    <tr>
                        <td colspan="2" data-medecin-id="27" data-jour="2024-06-03" data-heure-debut="17:00:00" data-heure-fin="17:30:00">17:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-04" data-heure-debut="11:00:00" data-heure-fin="11:30:00">11:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-04" data-heure-debut="17:00:00" data-heure-fin="17:30:00">17:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-05" data-heure-debut="11:00:00" data-heure-fin="11:30:00">11:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-05" data-heure-debut="17:00:00" data-heure-fin="17:30:00">17:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-06" data-heure-debut="11:00:00" data-heure-fin="11:30:00">11:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-06" data-heure-debut="17:00:00" data-heure-fin="17:30:00">17:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-07" data-heure-debut="11:00:00" data-heure-fin="11:30:00">11:00</td>
                    </tr>
                    <tr>
                        <td colspan="2" data-medecin-id="27" data-jour="2024-06-03" data-heure-debut="17:30:00" data-heure-fin="18:00:00">17:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-04" data-heure-debut="11:30:00" data-heure-fin="12:00:00">11:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-04" data-heure-debut="17:30:00" data-heure-fin="18:00:00">17:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-05" data-heure-debut="11:30:00" data-heure-fin="12:00:00">11:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-05" data-heure-debut="17:30:00" data-heure-fin="18:00:00">17:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-06" data-heure-debut="11:30:00" data-heure-fin="12:00:00">11:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-06" data-heure-debut="17:30:00" data-heure-fin="18:00:00">17:30</td>
                        <td data-medecin-id="27" data-jour="2024-06-07" data-heure-debut="11:30:00" data-heure-fin="12:00:00">11:30</td>
                    </tr>
                    <tr>
                        <td colspan="2" data-medecin-id="27" data-jour="2024-06-03" data-heure-debut="18:00:00" data-heure-fin="18:30:00">18:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-04" data-heure-debut="12:00:00" data-heure-fin="12:30:00">12:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-04" data-heure-debut="18:00:00" data-heure-fin="18:30:00">18:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-05" data-heure-debut="12:00:00" data-heure-fin="12:30:00">12:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-05" data-heure-debut="18:00:00" data-heure-fin="18:30:00">18:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-06" data-heure-debut="12:00:00" data-heure-fin="12:30:00">12:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-06" data-heure-debut="18:00:00" data-heure-fin="18:30:00">18:00</td>
                        <td data-medecin-id="27" data-jour="2024-06-07" data-heure-debut="12:00:00" data-heure-fin="12:30:00">12:00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 text-center">
                <div>
                    <a href="cvmedecin1.png" class="btn btn-primary mb-2 d-inline-block">Voir son CV</a>
                </div>
                <div>
                    <a href="com.html" class="btn btn-info mb-2 d-inline-block">Communiquer avec le médecin</a>
                </div>
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
    <script>
        $(document).ready(function(){
    // Fonction pour charger les créneaux réservés d'un médecin à partir du localStorage
    function chargerCreneauxReserves() {
        // Parcourir tous les médecins disponibles
        $("td").each(function(){
            var cellule = $(this);
            var medecinId = cellule.data("medecin-id");
            var jour = cellule.data("jour");
            var heureDebut = cellule.data("heure-debut");
            var heureFin = cellule.data("heure-fin");
            var cle = medecinId + "_" + jour + "_" + heureDebut + "_" + heureFin;

            // Vérifier si la case est déjà réservée dans le localStorage du médecin spécifié
            if (localStorage.getItem(cle) === "true") {
                cellule.addClass("table-danger");
            }
        });
    }

    // Écouteurs d'événements pour les cellules du tableau
    $("td").each(function(){
        var cellule = $(this);
        var medecinId = cellule.data("medecin-id");
        var jour = cellule.data("jour");
        var heureDebut = cellule.data("heure-debut");
        var heureFin = cellule.data("heure-fin");
        var cle = medecinId + "_" + jour + "_" + heureDebut + "_" + heureFin;

        // Ajouter un écouteur d'événements pour la réservation de créneaux
        cellule.click(function(){
            if (cellule.hasClass("table-danger")) {
                alert("La case est déjà réservée !");
            } else {
                $.ajax({
                    url: "rdv.php",
                    method: "POST",
                    data: {
                        medecin_id: medecinId,
                        date: jour,
                        heure_debut: heureDebut,
                        heure_fin: heureFin
                    },
                    success: function(response) {
                        if (response.trim() === "Créneau réservé avec succès.") {
                            alert(response);
                            cellule.addClass("table-danger");
                            // Enregistrer l'état de réservation dans le localStorage du médecin spécifié
                            localStorage.setItem(cle, "true");
                        } else {
                            alert("Erreur lors de la réservation du créneau : " + response);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("Erreur lors de la réservation du créneau : " + error);
                    }
                });
            }
        });
    });

    // Appel de la fonction pour charger les créneaux réservés pour tous les médecins
    chargerCreneauxReserves();
});

    </script>
</body>
</html>
