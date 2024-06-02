<?php
session_start();

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

// Récupération de l'ID du médecin sélectionné
$medecin_id = isset($_GET['medecin_id']) ? intval($_GET['medecin_id']) : 0;

// Récupération des informations du médecin sélectionné
$medecin_sql = "SELECT id, nom FROM medecins WHERE id = ?";
$medecin_stmt = $conn->prepare($medecin_sql);
$medecin_stmt->bind_param("i", $medecin_id);
$medecin_stmt->execute();
$medecin_result = $medecin_stmt->get_result();
$medecin = $medecin_result->fetch_assoc();

// Récupération des données du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérifier si l'utilisateur est connecté en tant que patient et récupérer son ID
    if (isset($_SESSION['patient_id'])) {
        $patient_id = $_SESSION['patient_id'];
    } else {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        header("Location: login.php");
        exit();
    }

    $date = $_POST['date'];
    $heure_debut = $_POST['heure_debut'];
    $heure_fin = $_POST['heure_fin'];
    $patient_id = $_SESSION['patient_id'];

    // Vérifier si le créneau est déjà réservé
    $check_sql = $conn->prepare("SELECT * FROM disponibilites WHERE medecin_id = ? AND date = ? AND heure_debut = ? AND heure_fin = ?");
    $check_sql->bind_param("isss", $medecin_id, $date, $heure_debut, $heure_fin);
    $check_sql->execute();
    $result = $check_sql->get_result();
    
    if ($result->num_rows > 0) {
        echo "Ce créneau est déjà réservé.";
    } else {
        // Requête d'insertion dans la table disponibilites
        $insert_sql = $conn->prepare("INSERT INTO disponibilites (medecin_id, date, heure_debut, heure_fin, est_reserve, patient_id) VALUES (?, ?, ?, ?, ?, ?)");
        $insert_sql->bind_param("isssii", $medecin_id, $date, $heure_debut, $heure_fin, $est_reserve, $patient_id);
        $est_reserve = 1;

        // Insérez ces lignes après l'insertion dans la table "disponibilites" avec succès
$dispo_id = $insert_sql->insert_id;

// Assurez-vous que les valeurs sont correctement liées pour l'insertion dans "rendezvous"
$insert_rdv_sql = $conn->prepare("INSERT INTO rendezvous (medecin_id, patient_id, disponibilite_id, date_rendezvous, heure_debut, heure_fin) VALUES (?, ?, ?, ?, ?, ?)");
$insert_rdv_sql->bind_param("iiisss", $medecin_id, $patient_id, $dispo_id, $date, $heure_debut, $heure_fin);

// Vérifiez si l'insertion dans "rendezvous" s'exécute avec succès
if ($insert_rdv_sql->execute() === TRUE) {
    echo "Créneau réservé avec succès et rendez-vous ajouté.";
} else {
    echo "Erreur lors de l'ajout du rendez-vous : " . $insert_rdv_sql->error;
}

    }
}

// Requête pour obtenir les créneaux horaires du médecin sélectionné
$dispo_sql = "SELECT m.nom as medecin_nom, d.date, d.heure_debut, d.heure_fin, d.est_reserve 
              FROM disponibilites d 
              JOIN medecins m ON d.medecin_id = m.id
              WHERE d.medecin_id = ?";
$dispo_stmt = $conn->prepare($dispo_sql);
$dispo_stmt->bind_param("i", $medecin_id);
$dispo_stmt->execute();
$dispo_result = $dispo_stmt->get_result();

// Récupération des créneaux déjà réservés
$reserves_sql = "SELECT m.nom as medecin_nom, r.date_rendezvous as date, r.heure_debut, r.heure_fin
                FROM rendezvous r
                JOIN medecins m ON r.medecin_id = m.id
                WHERE r.medecin_id = ?";
$reserves_stmt = $conn->prepare($reserves_sql);
$reserves_stmt->bind_param("i", $medecin_id);
$reserves_stmt->execute();
$reserves_result = $reserves_stmt->get_result();

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
                    <li class="nav-item"><a class="nav-link" href="accueil_client.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="tout_parcourir_client.php">Tout parcourir</a></li>
                    <li class="nav-item"><a class="nav-link" href="rdv_client.php">Rendez-vous</a></li>
                    <li class="nav-item"><a class="nav-link" href="compte_client.php">Votre compte</a></li>
                    <input type="text" id="searchInput" placeholder="Rechercher..." class="form-control mr-2" aria-label="Search">
                    <button class="btn btn-dark btn-sm" type="submit" onclick="search()">Rechercher</button>
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
        <form method="POST" action="rdv.php?medecin_id=<?php echo $medecin_id; ?>">
            <div class="form-group">
                <label for="medecin">Médecin sélectionné:</label>
                <input type="text" id="medecin" class="form-control" value="<?php echo htmlspecialchars($medecin['nom']); ?>" disabled>
                <input type="hidden" name="medecin_id" value="<?php echo $medecin_id; ?>">
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="heure_debut">Heure de début:</label>
                <select id="heure_debut" name="heure_debut" class="form-control" required>
                    <?php
                    // Affichage des créneaux de 30 minutes de 8h à 18h sauf de 12h à 14h
                    $start_time = strtotime("08:00");
                    $end_time = strtotime("18:00");
                    $current_time = $start_time;
                    while ($current_time < $end_time) {
                        $current_time_str = date("H:i", $current_time);
                        if ($current_time_str != "12:00" && $current_time_str != "12:30") {
                            echo "<option value='$current_time_str'>$current_time_str</option>";
                        }
                        $current_time = strtotime("+30 minutes", $current_time);
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="heure_fin">Heure de fin:</label>
                <select id="heure_fin" name="heure_fin" class="form-control" required>
                    <option value="">Sélectionnez une heure de fin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Réserver</button>
        </form>
        <script>
            // Script pour mettre à jour automatiquement l'heure de fin 30 minutes après l'heure de début
            document.getElementById('heure_debut').addEventListener('change', function() {
                var selectedStartTime = this.value;
                var endTimeSelect = document.getElementById('heure_fin');
                endTimeSelect.innerHTML = '';
                var start = new Date('2024-06-02T' + selectedStartTime + ':00');
                var end = new Date(start.getTime() + 30 * 60000); // 30 minutes after start time
                var endHour = end.getHours().toString().padStart(2, '0');
                var endMinutes = end.getMinutes().toString().padStart(2, '0');
                var endTime = endHour + ':' + endMinutes;
                endTimeSelect.innerHTML = "<option value='" + endTime + "'>" + endTime + "</option>";
            });
        </script>
        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th class="table-primary">Médecin</th>
                    <th class="table-primary">Date</th>
                    <th class="table-primary">Heure de début</th>
                    <th class="table-primary">Heure de fin</th>
                    <th class="table-primary">Disponibilité</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Affichage des créneaux horaires disponibles
                if ($dispo_result->num_rows > 0) {
                    while($row = $dispo_result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['medecin_nom'] . "</td>
                                <td>" . $row['date'] . "</td>
                                <td>" . $row['heure_debut'] . "</td>
                                <td>" . $row['heure_fin'] . "</td>
                                <td>" . ($row['est_reserve'] ? 'Réservé' : 'Disponible') . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Aucune disponibilité trouvée</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>



        </div>
        
        <footer class="page-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h6 class="text-uppercase font-weight-bold">Contact</h6>
                        <p>
                            37, quai de Grenelle, 75015 Paris, France <br>
                            info@webdynamique.ece.fr <br>
                            +33 01 02 03 04 05 <br>
                            +33 01 03 02 05 04
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
