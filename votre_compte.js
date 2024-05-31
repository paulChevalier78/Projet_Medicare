$(document).ready(function(){
    // Écouter l'événement de soumission du formulaire d'authentification des médecins
    $('#formMedecin').submit(function(event){
        // Empêcher le comportement par défaut du formulaire
        event.preventDefault();

        // Récupérer les valeurs des champs
        var nomMedecin = $('#nomMedecin').val();
        var prenomMedecin = $('#prenomMedecin').val();
        var emailMedecin = $('#emailMedecin').val();

        // Envoyer les données au serveur pour vérification
        $.ajax({
            type: 'POST',
            url: 'votre_compte.php',
            data: {nom: nomMedecin, prenom: prenomMedecin, email: emailMedecin},
            success: function(response){
                // Redirection vers la page compte_admin.html si l'authentification est réussie pour l'administrateur
                if(response.trim() === 'success: administrateur'){
                    window.location.href = 'compte_admin.php';
                } else if(response.trim() === 'success: medecin'){
                    // Redirection vers la page compte_medecin.html si l'authentification est réussie pour un médecin
                    window.location.href = 'compte_medecin.html';
                } else {
                    // Afficher un message d'erreur si l'authentification échoue
                    alert('Authentification échouée. Veuillez vérifier vos informations.');
                }
            }
        });
    });

    // Écouter l'événement de soumission du formulaire d'authentification des administrateurs
    $('#formAdministrateur').submit(function(event){
        // Empêcher le comportement par défaut du formulaire
        event.preventDefault();

        // Récupérer les valeurs des champs
        var nomAdmin = $('#nomAdmin').val();
        var prenomAdmin = $('#prenomAdmin').val();
        var emailAdmin = $('#emailAdmin').val();

        // Envoyer les données au serveur pour vérification
        $.ajax({
            type: 'POST',
            url: 'votre_compte.php',
            data: {nom: nomAdmin, prenom: prenomAdmin, email: emailAdmin},
            success: function(response){
                // Redirection vers la page compte_admin.html si l'authentification est réussie pour l'administrateur
                if(response.trim() === 'success: administrateur'){
                    window.location.href = 'compte_admin.php';
                } else if(response.trim() === 'success: medecin'){
                    // Redirection vers la page compte_medecin.html si l'authentification est réussie pour un médecin
                    window.location.href = 'compte_medecin.html';
                } else {
                    // Afficher un message d'erreur si l'authentification échoue
                    alert('Authentification échouée. Veuillez vérifier vos informations.');
                }
            }
        });
    });
});
