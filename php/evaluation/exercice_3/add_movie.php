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

$errors = [];
$title = $actors = $director = $producer = $year_of_prod = $language = $category = $storyline = $video = '';

if (!empty($_POST)) {
    // dump($_FILES); die;
    
    extract($_POST);
    
    if (empty($title)) {
        $errors[] = 'Please fill in the title';
    } elseif (strlen($title) > 5) {
        $errors[] = 'Title must be longer';
    }
    
    if (empty($actors)) {
        $errors[] = 'Please fill in the actors';
    } elseif (strlen($actors) > 5) {
        $errors[] = 'Actors must be longer';
    }
    
    if (empty($director)) {
        $errors[] = 'Please fill in the director';
    } elseif (strlen($director) > 5) {
        $errors[] = 'Director must be longer';
    }
    
    if (empty($producer)) {
        $errors[] = 'Please fill in the producer';
    } elseif (strlen($producer) > 5) {
        $errors[] = 'Producer must be longer';
    }
    
    if (empty($year_of_prod)) {
        $errors[] = 'Please fill in the year of production';
    } elseif (strlen($_POST['year_of_prod']) > 4) {
        $errors[] = 'Year of production must be 4 digit max YYYY';
    }
    
    if (empty($language)) {
        $errors[] = 'Please fill in the language';
    }
    
    if (empty($category)) {
        $errors[] = 'You have to choose a category';
    }
    
    if (empty($storyline)) {
        $errors[] = 'Please fill in the storyline';
    } elseif (strlen($director) > 5) {
        $errors[] = 'Storyline must be longer';
    }
    
    if (empty($video)) {
        $errors[] = 'Please fill in the link for the trailer video';
    }
        
        if (!empty($_GET['id'])) {
            $query = <<<SQL
UPDATE movies SET
    title = :title,
    actors = :actors,
    director = :director,
    producer = :producer,
    year_of_prod = :year_of_prod,
    language = :language,
    category = :category,
    storyline = :storyline,
    video = :video
WHERE id = :id
SQL;
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':title' => $title,
                ':actors' => $actors,
                ':director' => $director,
                ':producer' => $producer,
                ':year_of_prod' => $year_of_prod,
                ':language' => $language,
                ':category' => $category,
                ':storyline' => $storyline,
                ':video' => $video,
                ':id' => $_GET['id']
            ]);
        } else {
            $query = <<<SQL
INSERT INTO movies (
    title,
    actors,
    director,
    producer,
    year_of_prod,
    language,
    category,
    storyline,
    video
) VALUES (
    :title,
    :actors,
    :director,
    :producer,
    :year_of_prod,
    :language,
    :category,
    :storyline,
    :video
)
SQL;
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':title' => $title,
                ':actors' => $actors,
                ':director' => $director,
                ':producer' => $producer,
                ':year_of_prod' => $year_of_prod,
                ':language' => $language,
                ':category' => $category,
                ':storyline' => $storyline,
                ':video' => $video
            ]);
        }
        
        echo('Movie registered');
        header('Location:list.php');
        die;
}

// j'ai travaillé sur une base de données avec 3 films pour que les SELECT existent
// c'était avant de savoir que je devais pas joindre la base de donnée avec les fichiers
// pour construire le SELECT des catégories
$query2 = 'SELECT category FROM movies GROUP BY category';
$stmt2 = $pdo->query($query2);
$categories = $stmt2->fetchAll();

// pour construire le SELECT des langues
$query3 = 'SELECT language FROM movies GROUP BY language';
$stmt3 = $pdo->query($query3);
$languages = $stmt3->fetchAll();

// pour construire le SELECT des années de production
$query4 = 'SELECT year_of_prod FROM movies GROUP BY year_of_prod';
$stmt4 = $pdo->query($query4);
$yearprod = $stmt4->fetchAll();

if (!empty($errors)) :
?>
    <div class="alert alert-danger">
        <h5 class="alert-heading">Le formulaire contient des erreurs</h5>
        <?= implode('<br>', $errors); // transforme un tableau en chaîne de caractères ?>
    </div>
<?php
endif;
?>
      
<h3 class="text-center">
    <a href="list.php" class="nav-link">
        List of Movies
    </a>
</h3>
<h1 class="text-center">Add Movie</h1>

<div class="container">
    <form method="post">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title"
                class="form-control" value="<?= $title; ?>">
        </div>
        <div class="form-group">
            <label>Actors</label>
            <input type="text" name="actors"
                class="form-control" value="<?= $actors; ?>">
        </div>
        <div class="form-group">
            <label>Director</label>
            <input type="text" name="director"
                class="form-control" value="<?= $director; ?>">
        </div>
        <div class="form-group">
            <label>Producer</label>
            <input type="text" name="producer"
                class="form-control" value="<?= $producer; ?>">
        </div>
        <div class="form-group">
            <label>Year of production</label>
            <select name="year_of_prod" class="form-control">
                <option value=""></option>
                <?php
                foreach ($yearprod as $year_of_prod) :
                    $selected = $year_of_prod == $year_of_prod
                        ? 'selected'
                        : ''
                    ;
                ?>
                    <option value="<?= $year_of_prod['year_of_prod']; ?>" <?= $selected; ?>><?= $year_of_prod['year_of_prod']; ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Language</label>
            <select name="language" class="form-control">
                <option value=""></option>
                <?php
                foreach ($languages as $language) :
                    $selected = $language == $language
                        ? 'selected'
                        : ''
                    ;
                ?>
                    <option value="<?= $language['language']; ?>" <?= $selected; ?>><?= $language['language']; ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Category</label>
            <select name="category" class="form-control">
                <option value=""></option>
                <?php
                foreach ($categories as $category) :
                    $selected = $category == $category
                        ? 'selected'
                        : ''
                    ;
                ?>
                    <option value="<?= $category['category']; ?>" <?= $selected; ?>><?= $category['category']; ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Storyline</label>
            <textarea name="storyline"
                class="form-control"><?= $storyline; ?></textarea>
        </div>
        <div class="form-group">
            <label>Video</label>
            <input type="text" name="video"
                class="form-control" value="<?= $video; ?>">
        </div>
        <div class="form-btn-group text-right">
            <button type="submit" class="btn btn-info">
                Enregistrer
            </button>
            <a class="btn btn-alert" href="produits.php">
                Retour
            </a>
        </div>

    </form>

</div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>