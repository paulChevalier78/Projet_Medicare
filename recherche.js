function search() {
    var searchQuery = document.getElementById('searchInput').value.trim();
    
    // Vérifier si la requête de recherche est vide
    if (searchQuery === "") {
        alert("Veuillez entrer un nom ou un ID de médecin.");
        return;
    }

    // Appel du script PHP pour gérer la recherche
    $.ajax({
        type: 'POST',
        url: 'recherche.php',
        data: { query: searchQuery },
        success: function(response) {
            document.getElementById('searchResults').innerHTML = response;
        }
    });
}
