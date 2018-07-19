<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>Exercice 3</title>
  </head>
  <body>
<?php

$pdo = new PDO(
    'mysql:host=localhost;dbname=exercice_3', // chaîne de connexion
    'root', // utilisateur
    '', // mot de passe
    // Tableau d'options de connexion à la BDD
    [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);

$query = 'SELECT * FROM movies where id = ' . (int)$_GET['id'];
$stmt = $pdo->query($query);
$movie = $stmt->fetch();

?>

<div class="container">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title text-center" >
                    <?= $movie['title']; ?>
            </h1><br>
            <h2 class="card-text text-center">
                Director : <?= $movie['director']; ?>
            </h2><br>
            <h4 class="card-text text-center">
                Actors : <?= $movie['actors']; ?>
            </h4><br>
            <p class="card-text text-center">
                Producer : <?= $movie['producer']; ?>
            </p>
            <p class="card-text text-center">
                Year of production : <?= $movie['year_of_prod']; ?>
            </p>
            <p class="card-text text-center">
                Language : <?= $movie['language']; ?>
            </p>
            <p class="card-text text-center">
                Movie Category : <?= $movie['category']; ?>
            </p>
            <p class="card-text text-center">
                Storyline : <?= $movie['storyline']; ?>
            </p>
        </div>
        
        <a href="list.php" 
               class="btn btn-outline-info">
            Back to Movie List
        </a>

</div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>