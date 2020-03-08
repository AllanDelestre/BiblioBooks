<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>BiblioBooks.com</title>
</head>

<body>
    <header>
        <h1 style="text-align: center;">BiblioBooks</h1>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bibliotheque.php">Bibliothèque</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Saisir une recherche" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                </form>
            </div>
        </nav>
    </header>

    <div id="page-content">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <h1 class="font-weight-light mt-4">Liste complète de nos livres</h1>
                    <p class="font-weight-light mt-4 text-danger">Nos livres sont séléctionné par nos experts Romancier</p>
                    <p class="lead text-white-50"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Livre</th>
                    <th>Editeur</th>
                    <th>Année</th>
                    <th>Genre</th>
                    <th>Langue</th>
                    <th>Nombre de pages</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    function afficherLivre($livre)
                    {
                        echo ('<tr>');
                        echo ('<td>' . $livre['livre_nom'] . '</td>');
                        echo ('<td>' . $livre['editeur_nom'] . '</td>');
                        echo ('<td>' . $livre['livre_annee'] . '</td>');
                        echo ('<td>' . $livre['genre_libelle'] . '</td>');
                        echo ('<td>' . $livre['livre_langue'] . '</td>');

                        if ($livre['livre_nbpages'] != NULL) {
                            echo ('<td>' . $livre['livre_nbpages'] . '</td>');
                        } else {
                            echo ('<td> Non précisé </td>');
                        }

                        echo ('</tr>');
                    }

                    try {
                        //On se connecte à MySQL
                        $bdd = new PDO('mysql:host=localhost;dbname=projet_bibliotheque;charset=utf8', 'root', '');
                    } catch (Exception $e) {
                        //En cas d'erreur, on affiche un message et on arrête tout
                        die('Erreur : ' . $e->getMessage());
                    }

                    $reponse = $bdd->query(
                        'SELECT 
                        livre.titre AS livre_nom,
                        editeur.libelle AS editeur_nom,
                        livre.annee AS livre_annee,
                        genre.libelle AS genre_libelle,
                        langue.libelle AS livre_langue,
                        livre.nbpages AS livre_nbpages
                        
                        FROM livre
                        
                        JOIN genre ON genre.id = livre.genre
                        JOIN editeur ON editeur.id = livre.editeur
                        JOIN langue ON langue.id = livre.langue'
                    );

                    while ($livre = $reponse->fetch()) {
                        afficherLivre($livre);
                    }
                ?>

                <?php
                    $reponse->closeCursor(); //Termine le traitement de la requête
                ?>

            </tbody>
        </table>
    </div>

    <footer id="footer" class="py-4 bg-dark text-white-50">
        <div class="container text-center">
            <small>Copyright &copy; BiblioBooks.com</small>
        </div>
    </footer>
</body>

</html>