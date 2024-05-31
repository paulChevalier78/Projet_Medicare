$(document).ready(function(){
    $('#takeAppointmentBtn').click(function(){
        // Faites une requête AJAX pour récupérer les créneaux disponibles
        $.ajax({
            url: 'appointments.php',
            type: 'GET',
            dataType: 'json',
            success: function(heure_debut){
                if(heure_debut.success){
                    // Affichez les créneaux disponibles et permettez à l'utilisateur de sélectionner un créneau
                    showAvailableSlots(heure_debut.availableSlots);
                } else {
                    alert(heure_debut.message);
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
            success: function(heure_debut){
                if(heure_debut.success){
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



/*labBioMed*/
    $("#test").hide();
    $("#toggle").click(function(){
        $("#test").slideToggle()
    })

    $("#covid_hide").hide();                /*changer hide */
    $("#covid_button").hide();              /*changer button */

    $(".item-1").mouseenter(function(){     /* changer item */
        $("#covid_hide").slideToggle()      /*changer hide */
        $("#covid_button").slideToggle();   /*changer button */
    })

    $(".item-1").mouseleave(function(){     /* changer item */
        $("#covid_hide").slideToggle()      /*changer hide */
        $("#covid_button").slideToggle();   /*changer button */
    })

    /*______________________________________________________ */
    
    $("#preventive_hide").hide();                /*changer hide */
    $("#preventive_button").hide();              /*changer button */

    $(".item-2").mouseenter(function(){     /* changer item */
        $("#preventive_hide").slideToggle()      /*changer hide */
        $("#preventive_button").slideToggle();   /*changer button */
    })

    $(".item-2").mouseleave(function(){     /* changer item */
        $("#preventive_hide").slideToggle()      /*changer hide */
        $("#preventive_button").slideToggle();   /*changer button */
    })
    /*______________________________________________________ */
    
    $("#enceinte_hide").hide();                /*changer hide */
    $("#enceinte_button").hide();              /*changer button */

    $(".item-3").mouseenter(function(){     /* changer item */
        $("#enceinte_hide").slideToggle()      /*changer hide */
        $("#enceinte_button").slideToggle();   /*changer button */
    })

    $(".item-3").mouseleave(function(){     /* changer item */
        $("#enceinte_hide").slideToggle()      /*changer hide */
        $("#enceinte_button").slideToggle();   /*changer button */
    })

    /*______________________________________________________ */
    
    $("#routine_hide").hide();                /*changer hide */
    $("#routine_button").hide();              /*changer button */

    $(".item-4").mouseenter(function(){     /* changer item */
        $("#routine_hide").slideToggle()      /*changer hide */
        $("#routine_button").slideToggle();   /*changer button */
    })

    $(".item-4").mouseleave(function(){     /* changer item */
        $("#routine_hide").slideToggle()      /*changer hide */
        $("#routine_button").slideToggle();   /*changer button */
    })

    /*______________________________________________________ */
    
    $("#cancer_hide").hide();                /*changer hide */
    $("#cancer_button").hide();              /*changer button */

    $(".item-5").mouseenter(function(){     /* changer item */
        $("#cancer_hide").slideToggle()      /*changer hide */
        $("#cancer_button").slideToggle();   /*changer button */
    })

    $(".item-5").mouseleave(function(){     /* changer item */
        $("#cancer_hide").slideToggle()      /*changer hide */
        $("#cancer_button").slideToggle();   /*changer button */
    })

    /*______________________________________________________ */
    
    $("#gyneco_hide").hide();                /*changer hide */
    $("#gyneco_button").hide();              /*changer button */

    $(".item-6").mouseenter(function(){     /* changer item */
        $("#gyneco_hide").slideToggle()      /*changer hide */
        $("#gyneco_button").slideToggle();   /*changer button */
    })

    $(".item-6").mouseleave(function(){     /* changer item */
        $("#gyneco_hide").slideToggle()      /*changer hide */
        $("#gyneco_button").slideToggle();   /*changer button */
    })


    



});

/*labBioMed*/


/*rdv labo*/
$(document).ready(function() {
    console.log("Document ready!"); // Vérifiez que ce message apparaît

    $(".rdv").click(function() {
        // Récupérer les données de la cellule
        var heure = $(this).data("heure_debut");
        var jour = $(this).data("jour");
        var specialite = $('input[name="specialite"]:checked').val();

        console.log("Heure:", heure); // Vérifiez les valeurs
        console.log("Jour:", jour);
        console.log("Specialite:", specialite);

        // Vérifier qu'une spécialité est sélectionnée
        if (!specialite) {
            alert("Veuillez sélectionner une spécialité.");
            return;
        }

        // Envoyer les données au script PHP via AJAX
        $.ajax({
            url: 'rdv_labo.php',
            type: 'POST',
            data: {
                heure: heure,
                jour: jour,
                specialite: specialite
            },
            success: function(response) {
                console.log("Réponse serveur:", response); // Affichez la réponse serveur
                alert("ok");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown); // Affichez les erreurs
                alert("Erreur lors de l'enregistrement du rendez-vous.");
            }
        });
    });
});
