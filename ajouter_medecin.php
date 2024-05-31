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
        if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['contact']) && isset($_POST['email'])&& isset($_POST['mdp']) && isset($_POST['cv']) && isset($_POST['photo']) && isset($_POST['specialite'])){
           // Récupérer les valeurs du formulaire
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $contact = $_POST['contact'];
            $email = $_POST['email'];
            $mdp = $_POST['mdp'];
            $photo = $_POST['photo']; 
            $cv = $_POST['cv']; 
            $specialite = $_POST['specialite']; 


            // Requête SQL pour insérer un nouveau patient dans la table "patients"
            $requete_insertion = $connexion->prepare("INSERT INTO medecins (nom, prenom, contact, email, mdp, photo, cv, specialite) VALUES (:nom, :prenom, :contact, :email, :mdp, :photo, :cv, :specialite)");

            $requete_insertion->bindParam(':nom', $nom);
            $requete_insertion->bindParam(':prenom', $prenom);
            $requete_insertion->bindParam(':contact', $contact);
            $requete_insertion->bindParam(':email', $email);
            $requete_insertion->bindParam(':mdp', $mdp);
            $requete_insertion->bindParam(':photo', $photo);
            $requete_insertion->bindParam(':cv', $cv);
            $requete_insertion->bindParam(':specialite', $specialite);


            $requete_insertion->execute();


            $message = "Inscription réussie !";
            header("Location: connexion_medecin.php");
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
                        <label for="specialite">Spécialité :</label>
                        <select class="form-control" id="specialite" name="specialite" required>
                            <option value="">Sélectionnez une spécialité</option>
                            <option value="Généraliste">Généraliste</option>
                            <option value="Addictologue">Addictologue</option>
                            <option value="Andrologie">Andrologie</option>
                            <option value="Cardiologie">Cardiologie</option>
                            <option value="Dermatologie">Dermatologie</option>
                            <option value="Gastro-Hépato-Entérologie">Gastro-Hépato-Entérologie</option>
                            <option value="Gynécologie">Gynécologie</option>
                            <option value="I.S.T.">I.S.T.</option>
                            <option value="Ostéopathie">Ostéopathie</option>
                        </select>
                    </div>

                    <div class="form-group">
                          <label for="id">Lien photo :</label>
                             <input type="text" class="form-control" id="photo" name="photo" required>
                    </div>
                    <div class="form-group">
                        <label for="cv">Lien cv:</label>
                        <input type="text" class="form-control" id="cv" name="cv" required>
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
