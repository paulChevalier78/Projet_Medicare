<?php
session_start();

// Détruire toutes les variables de session
$_SESSION = array();

// Si vous souhaitez détruire complètement la session, effacez également le cookie de session.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalement, détruire la session.
session_destroy();

// Inclure du HTML et un script pour rediriger vers "votre_compte.php"
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container text-center mt-5">
        <h1>Déconnexion réussie</h1>
        <p>Vous allez être redirigé vers la page de connexion.</p>
        <p>Si la redirection ne fonctionne pas, cliquez sur le bouton ci-dessous :</p>
        <a href="votre_compte.php" class="btn btn-primary">Retour à la connexion</a>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = 'votre_compte.php';
        }, 3000); // Redirige après 3 secondes
    </script>
</body>
</html>
