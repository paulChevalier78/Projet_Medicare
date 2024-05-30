    <?php
    $servername = "localhost";
    $username = "root"; 
    $password = "root"; 
    $dbname = "rdv";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['action'])) {
            $action = $_POST['action'];

            if($action == 'ajouter') {
                $nom = $_POST["nomMedecin"];
                $prenom = $_POST["prenomMedecin"];
                $specialite = $_POST["specialiteMedecin"];
                $contact = $_POST["contactMedecin"];
                $email = $_POST["emailMedecin"];
                $cv = $_POST["cvMedecin"];
                $photo = $_POST["photoMedecin"];

                $sql = "INSERT INTO medecins (nom, prenom, specialite, contact, email, cv, photo) VALUES ('$nom', '$prenom', '$specialite', '$contact', '$email', '$cv', '$photo')";

                if ($conn->query($sql) === TRUE) {
                    echo "Nouveau médecin ajouté avec succès.";
                } else {
                    echo "Erreur : " . $sql . "<br>" . $conn->error;
                }
            } elseif($action == 'supprimer') {
                $nom = $_POST["nomMedecinSupprimer"];
                $prenom = $_POST["prenomMedecinSupprimer"];
                $specialite = $_POST["specialiteMedecinSupprimer"];
                $contact = $_POST["contactMedecinSupprimer"];
                $email = $_POST["emailMedecinSupprimer"];
                $cv = $_POST["cvMedecinSupprimer"];
                $photo = $_POST["photoMedecinSupprimer"];

                $sql = "DELETE FROM medecins WHERE nom='$nom' AND prenom='$prenom' AND specialite='$specialite' AND contact='$contact' AND email='$email' AND cv='$cv' AND photo='$photo'";

                if ($conn->query($sql) === TRUE) {
                    echo "Médecin supprimé avec succès.";
                } else {
                    echo "Erreur : " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }

    $conn->close();
    
    ?>
