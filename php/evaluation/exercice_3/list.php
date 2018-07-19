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
      <div class="container">
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

$query = "SELECT * FROM movies";
$stmt = $pdo->query($query);
$movies = $stmt->fetchAll();
?>
      
        <h1 class="text-center">List of movies</h1><br>
    
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Director</th>
      <th scope="col">Year of Production</th>
      <th width="150px"></th>
    </tr>
  </thead>
  <tbody>
<?php
    foreach ($movies as $movie) :
?>
    <tr>
        <td><?= $movie['title']; ?></td>
        <td><?= $movie['director']; ?></td>
        <td><?= $movie['year_of_prod']; ?></td>
        <td>
            <a href="movie.php?id=<?= $movie['id']; ?>" 
               class="btn btn-info btn-sm">
                  More info
            </a>
        </td>
    </tr>
<?php
  endforeach;
?>
  </tbody>
</table>
      
      <h2>
          <a href="add_movie.php" 
       class="nav-link text-center">
            Add Movie
          </a>  
      </h2>
     
      </div>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>