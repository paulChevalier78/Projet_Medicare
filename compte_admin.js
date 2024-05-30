$(document).ready(function(){
    // Gestionnaire d'événements pour le clic sur le bouton "Ajouter un médecin"
    $("#ajouterMedecin").click(function(){
        $("#saisieMedecin").slideToggle();
    });

    // Gestionnaire d'événements pour le clic sur le bouton "Valider"
    $("#validerMedecin").click(function(){
        var nomMedecin = $("#nomMedecin").val();
        var prenomMedecin = $("#prenomMedecin").val();
        var specialiteMedecin = $("#specialiteMedecin").val();
        var contactMedecin = $("#contactMedecin").val();
        var emailMedecin = $("#emailMedecin").val();
        var cvMedecin = $("#cvMedecin").val();
        var photoMedecin = $("#photoMedecin").val();

        $.ajax({
            type: "POST",
            url: "compte_admin.php", // Modifier le nom du fichier PHP vers lequel envoyer la requête
            data: { 
                action: 'ajouter',
                nomMedecin: nomMedecin,
                prenomMedecin: prenomMedecin,
                specialiteMedecin: specialiteMedecin,
                contactMedecin: contactMedecin,
                emailMedecin: emailMedecin,
                cvMedecin: cvMedecin,
                photoMedecin: photoMedecin
            },
            success: function(response){
                console.log(response);
                $("#resultatSaisie").text("Nom du médecin ajouté : " + nomMedecin);
                $("#saisieMedecin").slideUp();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Gestionnaire d'événements pour le clic sur le bouton "Afficher le formulaire de suppression"
    $("#afficherFormulaireSuppression").click(function(){
        $("#suppressionMedecin").slideToggle();
    });

    // Gestionnaire d'événements pour le clic sur le bouton "Valider la suppression"
    $("#validerSuppressionMedecin").click(function(){
        var nomMedecinSupprimer = $("#nomMedecinSupprimer").val();
        var prenomMedecinSupprimer = $("#prenomMedecinSupprimer").val();
        var specialiteMedecinSupprimer = $("#specialiteMedecinSupprimer").val();
        var contactMedecinSupprimer = $("#contactMedecinSupprimer").val();
        var emailMedecinSupprimer = $("#emailMedecinSupprimer").val();
        var cvMedecinSupprimer = $("#cvMedecinSupprimer").val();
        var photoMedecinSupprimer = $("#photoMedecinSupprimer").val();

        $.ajax({
            type: "POST",
            url: "compte_admin.php", // Modifier le nom du fichier PHP vers lequel envoyer la requête
            data: { 
                action: 'supprimer',
                nomMedecinSupprimer: nomMedecinSupprimer,
                prenomMedecinSupprimer: prenomMedecinSupprimer,
                specialiteMedecinSupprimer: specialiteMedecinSupprimer,
                contactMedecinSupprimer: contactMedecinSupprimer,
                emailMedecinSupprimer: emailMedecinSupprimer,
                cvMedecinSupprimer: cvMedecinSupprimer,
                photoMedecinSupprimer: photoMedecinSupprimer
            },
            success: function(response){
                console.log(response);
                $("#resultatSaisie").text("Nom du médecin supprimé : " + nomMedecinSupprimer);
                $("#suppressionMedecin").slideUp();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Gestionnaire d'événements pour le clic sur le bouton "Créer fichier XML"
    $("#creerFichierXML").click(function(){
        // Ouvrir le fichier XML dans une nouvelle fenêtre de navigateur
        window.open("julia_molinari.xml", "_blank");
    });
});
