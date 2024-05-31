$(document).ready(function(){
    $('#takeAppointmentBtn').click(function(){
        // Faites une requête AJAX pour récupérer les créneaux disponibles
        $.ajax({
            url: 'appointments.php',
            type: 'GET',
            dataType: 'json',
            success: function(response){
                if(response.success){
                    // Affichez les créneaux disponibles et permettez à l'utilisateur de sélectionner un créneau
                    showAvailableSlots(response.availableSlots);
                } else {
                    alert(response.message);
                }
            },
            error: function(){
                alert('Error occurred while fetching available slots.');
            }
        });
    });
    
    $(document).on('click', '.appointment-slot', function(){
        var selectedSlot = $(this).text();
        // Faites une requête AJAX pour réserver le créneau sélectionné
        $.ajax({
            url: 'appointments.php',
            type: 'POST',
            dataType: 'json',
            data: {slot: selectedSlot},
            success: function(response){
                if(response.success){
                    alert('Votre rendez-vous a été réservé avec succès.');
                    // Mettez à jour l'apparence du créneau réservé
                    $(this).addClass('booked').removeClass('appointment-slot');
                } else {
                    alert('Une erreur est survenue lors de la réservation du rendez-vous.');
                }
            }.bind(this),
            error: function(){
                alert('Error occurred while booking the appointment.');
            }
        });
    });
});

function afficherMedecins(specialite) {
    var url = 'liste_medecins.php?specialite=' + encodeURIComponent(specialite);
    window.location.href = url;
}
function afficherMedecin(specialite) {
    var url = 'liste_medecins_client.php?specialite=' + encodeURIComponent(specialite);
    window.location.href = url;
}


        $(document).ready(function() {
            // Fonction pour gérer le clic sur un créneau
            $('td[data-medecin-id]').click(function() {
                // Récupérer les informations du créneau
                var medecinId = $(this).data('medecin-id');
                var jour = $(this).data('jour');
                var heureDebut = $(this).data('heure-debut');
                var heureFin = $(this).data('heure-fin');

                // Envoyer une requête AJAX pour enregistrer la réservation
                $.ajax({
                    type: 'POST',
                    url: 'enregistrer_reservation.php', // Remplacez 'enregistrer_reservation.php' par le fichier PHP qui gère l'enregistrement dans la base de données
                    data: {
                        medecinId: medecinId,
                        jour: jour,
                        heureDebut: heureDebut,
                        heureFin: heureFin
                    },
                    success: function(response) {
                        // Traiter la réponse de la requête
                        if (response === 'success') {
                            alert('Créneau réservé avec succès !');
                        } else {
                            alert('Erreur lors de la réservation.');
                        }
                    }
                });
            });
        });

        