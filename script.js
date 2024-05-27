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

function showAvailableSlots(slots){
    var slotsHtml = '<div class="container"><h2>Créneaux disponibles</h2>';
    slots.forEach(function(slot){
        slotsHtml += '<div class="appointment-slot">' + slot + '</div>';
    });
    slotsHtml += '</div>';
    $('body').html(slotsHtml);
}
