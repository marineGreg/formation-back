<?php
require_once __DIR__ . '/../include/init.php';
adminSecurity();

$errors = [];
$nom = '';

if (!empty($_POST)) { // si le formulaire a été soumis
    // nettoyage des données du formulaire (cf include/fonctions.php)
    sanitizePost();
    // créé des variables à partir d'un tableau
    // les variables ont les noms des clés dans le tableau
    extract($_POST);
    
    // test de la saisie du champ nom
    if (empty($_POST['nom'])) {
       $errors[] = 'Le nom est obligatoire';
    } elseif (strlen($_POST['nom']) > 50) {
        $errors[] = 'Le nom ne doit pas faire plus de 50 caractères';
    }
    
    // si le formulaire est bien rempli, le tableau d'erreur est vide
    if (empty($errors)) {
        if (isset($_GET['id'])) { // modification
            $query = 'UPDATE categorie SET nom = :nom WHERE id = :id';
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':nom' => $nom,
                ':id' => $$_GET['id']
            ]);
        } else { // création
            // insertion en bdd
            $stmt = $pdo->prepare('INSERT INTO categorie(nom) VALUES (:nom)');
            $stmt->execute([':nom' => $nom]);
        }
        // enregistrement d'un message en session
        setFlashMessage('La catégorie est enregistrée');
        // redirection vers la page de liste
        header('Location: categories.php');
        die; // termine l'exécution du script
    }
} elseif (isset($_GET['id'])) {
    // en modifictation, si on n'a pas de retour de formulaire 
    // on va chercher la catégorie en bdd pour affichage
    $query = 'SELECT * FROM categorie WHERE id=' . (int)$_GET['id'];
    $stmt = $pdo->query($query);
    $categorie = $stmt->fetch();
    $nom = $categorie['nom'];
}

require __DIR__ . '/../layout/top.php';

if (!empty($errors)) :
?>
    <div class="alert alert-danger">
        <h5 class="alert-heading">
            Le formulaire contient des erreurs
        </h5>
        <?= implode('<br>', $errors); // transforme un array en string ?>
    </div>
<?php
endif;
?>
<h1>Edition catégorie</h1>

<form method="post">
    <div class="form-group">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" value="<?= $nom ?>">
    </div>
    <div class="form-btn-group text-right">
        <button type="submit" class="btn btn-outline-info">
            Enregistrer
        </button>
        <a class="btn btn-outline-secondary" href="categories.php">
            Retour
        </a>
    </div>
</form>
<?php
require __DIR__ . '/../layout/bottom.php';
?>