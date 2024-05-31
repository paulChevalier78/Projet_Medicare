<?php

// Simuler une liste de créneaux disponibles
$availableSlots = [
    "2024-05-27 09:00:00",
    "2024-05-27 10:00:00",
    "2024-05-27 11:00:00",
    // Ajoutez d'autres créneaux disponibles ici
];

// Simuler un rendez-vous pris
$bookedSlot = $_POST['slot']; // Créneau sélectionné par l'utilisateur
if ($bookedSlot) {
    // Ici, vous pouvez enregistrer le rendez-vous dans la base de données ou envoyer une notification
    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'No slot booked.']);
