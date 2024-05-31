$(document).ready(function(){
    // Intercepter la soumission du formulaire
    $("#formMedecin").submit(function(event) {
        // Empêcher le comportement par défaut du formulaire
        event.preventDefault();

        // Récupérer les valeurs du formulaire
        var nom = $("#nomMedecin").val();
        var prenom = $("#prenomMedecin").val();
        var telephone = $("#telephoneMedecin").val();
        var email = $("#emailMedecin").val();

        // Envoyer les données du formulaire au serveur via AJAX
        $.ajax({
            type: "POST",
            url: "inscription.php", // Le fichier PHP pour traiter les données
            data: {
                nom: nom,
                prenom: prenom,
                telephone: telephone,
                email: email
            },
            success: function(data) {
                // Afficher le résultat de l'ajout du patient
                alert(data);
            }
        });
    });
});
