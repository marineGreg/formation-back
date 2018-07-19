<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>Exercice 1</title>
  </head>
  <body>
      
<?php

// je créé le tableau contenant les données de différents utilisateurs
$utilisateurs = array (
    array (
        'nom' => 'GREGOIRE',
        'prenom' => 'Marine',
        'adresse' => '62 Rue des Tournelles',
        'cp' => '75003',
        'ville' => 'Paris',
        'email' => 'marinegregoire1@gmail.com',
        'telephone' => '06 72 11 76 95',
        'date_naissance' => '1987-12-11'
    ),
    array (
        'nom' => 'VICENTE',
        'prenom' => 'Theodore',
        'adresse' => '62B Rue Pierre Demours',
        'cp' => '75017',
        'ville' => 'Paris',
        'email' => 'theodore.vicente@gmail.com',
        'telephone' => '06 07 02 68 38',
        'date_naissance' => '1991-10-19'
    ),
    array (
        'nom' => 'ENJALBAL',
        'prenom' => 'Pascale',
        'adresse' => '2 Place des Arcades',
        'cp' => '06250',
        'ville' => 'Mougins',
        'email' => 'pascaleenjalbal@gmail.com',
        'telephone' => '06 10 55 58 85',
        'date_naissance' => '1961-06-29'
    )
);

// fonction pour le formatage de la date en jj/mm/AAAA
function datetimeFr($datetime)
{
    return date('d/m/Y', strtotime($datetime));
}

/**
 * echo '<pre>';
 * var_dump($utilisateurs);
 * echo '</pre>';
 */

?>
      <h1>Exercice 1</h1>
    
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
            <th scope="col">Adresse</th>
            <th scope="col">Code Postal</th>
            <th scope="col">Ville</th>
            <th scope="col">email</th>
            <th scope="col">Telephone</th>
            <th scope="col">Date de naissance</th>
        </tr>
    </thead>
    <tbody>
<?php
    // je boucle pour afficher le contenu de ce tableau dans un tableau HTML
  foreach ($utilisateurs as $utilisateur) :
?>
        <tr>
            <td><?= $utilisateur['nom']; ?></td>
            <td><?= $utilisateur['prenom']; ?></td>
            <td><?= $utilisateur['adresse']; ?></td>
            <td><?= $utilisateur['cp']; ?></td>
            <td><?= $utilisateur['ville']; ?></td>
            <td><?= $utilisateur['email']; ?></td>
            <td><?= $utilisateur['telephone']; ?></td>
            <td><?= datetimeFr($utilisateur['date_naissance']); ?></td>
        </tr>
<?php
  endforeach;
?>
    </tbody>
</table>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>