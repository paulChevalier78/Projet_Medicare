document.addEventListener('DOMContentLoaded', function() {
    var planningTable = document.getElementById('planning');

    // Ajoutez un gestionnaire d'événements clic pour chaque cellule
    planningTable.addEventListener('click', function(event) {
        var targetCell = event.target;

        // Vérifie si la cellule est vide (pas occupée)
        if (!targetCell.classList.contains('occupied')) {
            // Vérifie si la cellule est déjà réservée (bleue)
            if (!targetCell.classList.contains('table-primary')) {
                // Récupère les données de la cellule (ID du médecin, jour, heure)
                var medecinId = targetCell.getAttribute('data-medecin-id');
                var jour = targetCell.getAttribute('data-jour');
                var heureDebut = targetCell.getAttribute('data-heure-debut');
                var heureFin = targetCell.getAttribute('data-heure-fin');

                // Envoie une requête POST pour ajouter la réservation
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'reserver_creneau.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Vérifie si les valeurs de temps ne sont pas nulles avant de colorer la cellule
                        if (heureDebut !== null && heureFin !== null) {
                            // Changer la couleur de la cellule sur laquelle vous avez cliqué
                            targetCell.classList.add('table-primary');
                        }
                        alert(xhr.responseText); // Affiche la réponse du serveur (succès ou erreur)
                    } else {
                        alert('Erreur lors de la requête.');
                    }
                };
                xhr.send('action=ajouter_reservation&medecin_id=' + medecinId + '&jour=' + jour + '&heure_debut=' + heureDebut + '&heure_fin=' + heureFin);
            } else {
                alert('Ce créneau est déjà occupé.');
            }
        } else {
            alert('Ce créneau est déjà occupé.');
        }
    });
});
