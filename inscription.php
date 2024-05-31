<?php

    // Paramètres de connexion à la base de données
    $serveur = "localhost";
    $utilisateur = "root";
    $mot_de_passe = "root";
    $base_de_donnees = "rdv";

    $message = ""; // Initialisation du message

    try {
        // Connexion à la base de données avec PDO
        $connexion = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $mot_de_passe);

        // Définition de l'attribut PDO pour afficher les erreurs SQL
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier si les données du formulaire ont été envoyées
        if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['contact']) && isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST['id']) && isset($_POST['adresse1']) && isset($_POST['adresse2']) && isset($_POST['ville']) && isset($_POST['code_postal']) && isset($_POST['pays']) && isset($_POST['numero_carte']) && isset($_POST['nom_carte']) && isset($_POST['date_expiration']) && isset($_POST['code_securite'])){
           // Récupérer les valeurs du formulaire
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $contact = $_POST['contact'];
            $email = $_POST['email'];
            $mdp = $_POST['mdp'];
            $id = $_POST['id']; // Récupération du numéro de sécurité sociale
            $adresse1 = $_POST['adresse1'];
            $adresse2 = $_POST['adresse2'];
            $ville = $_POST['ville'];
            $code_postal = $_POST['code_postal'];
            $pays = $_POST['pays'];
            $numero_carte = $_POST['numero_carte'];
            $nom_carte = $_POST['nom_carte'];
            $date_expiration = $_POST['date_expiration'];
            $code_securite = $_POST['code_securite'];

            // Requête SQL pour insérer un nouveau patient dans la table "patients"
            $requete_insertion = $connexion->prepare("INSERT INTO patients (nom, prenom, contact, email, mdp, id, adresse1, adresse2, ville, code_postal, pays, numero_carte, nom_carte, date_expiration, code_securite) VALUES (:nom, :prenom, :contact, :email, :mdp, :id, :adresse1, :adresse2, :ville, :code_postal, :pays, :numero_carte, :nom_carte, :date_expiration, :code_securite)");
            $requete_insertion->bindParam(':nom', $nom);
            $requete_insertion->bindParam(':prenom', $prenom);
            $requete_insertion->bindParam(':contact', $contact);
            $requete_insertion->bindParam(':email', $email);
            $requete_insertion->bindParam(':mdp', $mdp);
            $requete_insertion->bindParam(':id', $id); // Liaison du numéro de sécurité sociale
            $requete_insertion->bindParam(':adresse1', $adresse1);
            $requete_insertion->bindParam(':adresse2', $adresse2);
            $requete_insertion->bindParam(':ville', $ville);
            $requete_insertion->bindParam(':code_postal', $code_postal);
            $requete_insertion->bindParam(':pays', $pays);
            $requete_insertion->bindParam(':numero_carte', $numero_carte);
            $requete_insertion->bindParam(':nom_carte', $nom_carte);
            $requete_insertion->bindParam(':date_expiration', $date_expiration);
            $requete_insertion->bindParam(':code_securite', $code_securite);
            $requete_insertion->execute();

            $message = "Inscription réussie !";
            header("Location: connexion.php");
            exit();
        }
    } catch(PDOException $e) {
        // En cas d'erreur lors de la connexion à la base de données, afficher l'erreur
        $message = "Erreur de connexion à la base de données : " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="accueil.html">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="toutParcourir.html">Tout parcourir</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Recherche</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Rendez-vous</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Votre compte</a></li>
                    <li class="nav-item"><a class="nav-link" href="connexion.php">Se connecter</a></li>
                </ul>
            </div>
        </nav>

        <div class="container d-flex justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Inscription</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom :</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact :</label>
                        <input type="text" class="form-control" id="contact" name="contact" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Adresse Email :</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="mdp">Mot de passe :</label>
                        <input type="password" class="form-control" id="mdp" name="mdp" required>
                    </div>
                    <div class="form-group">
                          <label for="id">Numéro de sécurité sociale :</label>
                             <input type="text" class="form-control" id="id" name="id" required>
                    </div>
                    <div class="form-group">
                        <label for="adresse1">Adresse Ligne 1:</label>
                        <input type="text" class="form-control" id="adresse1" name="adresse1" required>
                    </div>
                    <div class="form-group">
                        <label for="adresse2">Adresse Ligne 2:</label>
                        <input type="text" class="form-control" id="adresse2" name="adresse2">
                    </div>
                    <div class="form-group">
                        <label for="ville">Ville:</label>
                        <input type="text" class="form-control" id="ville" name="ville" required>
                    </div>
                    <div class="form-group">
                        <label for="code_postal">Code Postal:</label>
                        <input type="text" class="form-control" id="code_postal" name="code_postal" required>
                    </div>
                    <div class="form-group">
                        <label for="pays">Pays:</label>
                        <input type="text" class="form-control" id="pays" name="pays" required>
                    </div>
                    <div class="form-group
                    <div class="form-group">
                        <label for="numero_carte">Numéro de la carte :</label>
                        <input type="text" class="form-control" id="numero_carte" name="numero_carte" required>
                    </div>
                    <div class="form-group">
                        <label for="nom_carte">Nom affiché sur la carte :</label>
                        <input type="text" class="form-control" id="nom_carte" name="nom_carte" required>
                    </div>
                    <div class="form-group">
                        <label for="date_expiration">Date d'expiration de la carte :</label>
                        <input type="date" class="form-control" id="date_expiration" name="date_expiration" required>
                    </div>
                    <div class="form-group">
                        <label for="code_securite">Code de sécurité :</label>
                        <input type="text" class="form-control" id="code_securite" name="code_securite" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
                </form>
                <?php if (!empty($message)): ?>
                <div class="alert alert-success mt-3" role="alert">
                    <?php echo $message; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <footer class="page-footer">
            <div class="container">
                <!-- Votre pied de page ici -->
            </div>
        </footer>
    </div>
</body>
</html>
