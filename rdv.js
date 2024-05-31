$(document).ready(function(){
    // Fonction pour charger les créneaux réservés d'un médecin à partir du localStorage
    function chargerCreneauxReserves() {
        // Parcourir tous les médecins disponibles
        $("td").each(function(){
            var cellule = $(this);
            var medecinId = cellule.data("medecin-id");
            var jour = cellule.data("jour");
            var heureDebut = cellule.data("heure-debut");
            var heureFin = cellule.data("heure-fin");
            var cle = medecinId + "_" + jour + "_" + heureDebut + "_" + heureFin;

            // Vérifier si la case est déjà réservée dans le localStorage du médecin spécifié
            if (localStorage.getItem(cle) === "true") {
                cellule.addClass("table-danger");
            }
        });
    }

    // Écouteurs d'événements pour les cellules du tableau
    $("td").each(function(){
        var cellule = $(this);
        var medecinId = cellule.data("medecin-id");
        var jour = cellule.data("jour");
        var heureDebut = cellule.data("heure-debut");
        var heureFin = cellule.data("heure-fin");
        var cle = medecinId + "_" + jour + "_" + heureDebut + "_" + heureFin;

        // Ajouter un écouteur d'événements pour la réservation de créneaux
        cellule.click(function(){
            if (cellule.hasClass("table-danger")) {
                alert("La case est déjà réservée !");
            } else {
                $.ajax({
                    url: "rdv.php",
                    method: "POST",
                    data: {
                        medecin_id: medecinId,
                        date: jour,
                        heure_debut: heureDebut,
                        heure_fin: heureFin
                    },
                    success: function(response) {
                        if (response.trim() === "Créneau réservé avec succès.") {
                            alert(response);
                            cellule.addClass("table-danger");
                            // Enregistrer l'état de réservation dans le localStorage du médecin spécifié
                            localStorage.setItem(cle, "true");
                        } else {
                            alert("Erreur lors de la réservation du créneau : " + response);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("Erreur lors de la réservation du créneau : " + error);
                    }
                });
            }
        });
    });

    // Appel de la fonction pour charger les créneaux réservés pour tous les médecins
    chargerCreneauxReserves();
});
