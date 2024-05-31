<!DOCTYPE html>
<html>
<head>
    <title>Medicare</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="wrapper">
    <header class="site-header">
        <a href="#"><img src="loog.png" alt="Logo" class="header-logo"></a>
    </header>
    
    <nav class="navbar navbar-expand-md">
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main-navigation">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="accueil_client.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="tout_parcourir_client.php">Tout parcourir</a></li>
                    <li class="nav-item"><a class="nav-link" href="rdv_client.php">Rendez-vous</a></li>
                    <li class="nav-item"><a class="nav-link" href="compte_client.php">Votre compte</a></li>
                    <input type="text" id="searchInput" placeholder="Rechercher..." class="form-control mr-2" aria-label="Search">
                <button class="btn btn-dark btn-sm" type="submit"  onclick="search()" >Rechercher</button>
                </ul>
            </div>
            <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white" href="deconnexion_admin.php">Se déconnecter</a>
                    </li>
                </ul>
        </nav>
        <div id="searchResults"></div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="med2.jpg" alt="Dr Martin Anne" class="img-fluid mb-3">
                    <div>
                        <a href="cvmedecin1.png" class="btn btn-primary mb-2 d-inline-block">Voir son CV</a>
                        <a href="dispo5.php" class="btn btn-success mb-2 d-inline-block">Prendre un RDV</a>
                        <a href="com.html" class="btn btn-info mb-2 d-inline-block">Communiquer avec le médecin</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <h1>Dr Thomas Paul</h1>
                    <p><strong>Bureau :</strong> 25 Rue Pierre Demours, 75017 Paris</p>
                    <p><b>Téléphone :</b> 0656897536</p>
                    <p><b>Email :</b> julia.molinari@gmail.com</p>
                    <div class="googleMap mb-3">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2623.793962594644!2d2.2916792765000458!3d48.881204199100715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66f93c710ffc3%3A0x1b7a4accb4db6b6f!2s25%20Rue%20Pierre%20Demours%2C%2075017%20Paris!5e0!3m2!1sfr!2sfr!4v1716736890081!5m2!1sfr!2sfr" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="table-primary" colspan="1" rowspan="2">Spécialité</th>
                        <th class="table-primary" colspan="1" rowspan="2">Médecin</th>
                        <th class="table-success" colspan="2" rowspan="1">Lundi</th>
                        <th class="table-success" colspan="2" rowspan="1">Mardi</th>
                        <th class="table-success" colspan="2" rowspan="1">Mercredi</th>
                        <th class="table-success" colspan="2" rowspan="1">Jeudi</th>
                        <th class="table-success" colspan="2" rowspan="1">Vendredi</th>
                        <th class="table-success" colspan="2" rowspan="1">Samedi</th>
                        <th class="table-success" colspan="2" rowspan="1">Dimanche</th>
                    </tr>
                    <tr>
                        <td colspan="2" class="table-warning">PM</td>
                        <td class="table-danger">AM</td>
                        <td class="table-warning">PM</td>
                        <td class="table-danger">AM</td>
                        <td class="table-warning">PM</td>
                        <td class="table-danger">AM</td>
                        <td class="table-warning">PM</td>
                        <td class="table-danger">AM</td>
                        <td class="table-warning">PM</td>
                        <td class="table-danger">AM</td>
                        <td class="table-warning">PM</td>
                        <td class="table-danger">AM</td>
                        <td class="table-warning">PM</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Médecin généraliste</td>
                        <td>Julia Molinari</td>
                        <td colspan="2" class="table-light"></td>
                        <td class="table-light"></td>
                        <td class="table-light"></td>
                        <td class="table-light"></td>
                        <td class="table-dark"></td>
                        <td class="table-dark"></td>
                        <td class="table-light"></td>
                        <td class="table-dark"></td>
                        <td class="table-dark"></td>
                        <td class="table-dark"></td>
                        <td class="table-dark"></td>
                        <td class="table-dark"></td>
                        <td class="table-dark"></td>                      
                    </tr>
                </tbody>
            </table>
        </div>
        
        <footer class="page-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h6 class="text-uppercase font-weight-bold">Information additionnelle</h6>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque interdum quam odio, quis placerat ante luctus eu. Sed aliquet dolor id sapien rutrum, id vulputate quam iaculis.
                        </p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h6 class="text-uppercase font-weight-bold">Contact</h6>
                        <p>
                            10 Rue Sextius Michel, 75015 Paris, France <br>
                            info@webDynamique.ece.fr <br>
                            +33 01 02 03 04 05 <br>
                            +33 01 03 02 05 04
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="googleMap">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5250.744877226207!2d2.2859626764985514!3d48.85110800121883!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b486bb253%3A0x61e9cc6979f93fae!2s10%20Rue%20Sextius%20Michel%2C%2075015%20Paris!5e0!3m2!1sfr!2sfr!4v1716713668012!5m2!1sfr!2sfr" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copyright text-center">&copy; 2019 Copyright | Droit d'auteur: webDynamique.ece.fr</div>
        </footer>
                
    </div>
</body>
</html>
