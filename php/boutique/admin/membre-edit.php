<?php

require_once __DIR__ . '/../include/init.php';
adminSecurity();

$errors = [];
$civilite = $nom = $prenom = $email = $ville = $cp = $adresse = '';

if (!empty($_POST)) {
    sanitizePost();
    extract($_POST); // extract($_POST) s'est déjà chargé de récupérer les variables
    
    if (empty($civilite)) { // du coup, on peut faire $civilite au lieu de ($_POST['civilite'])
        $errors[] = 'La civilité est obligatoire';
    }
    
    if (empty($nom)) {
        $errors[] = 'Le nom est obligatoire';
    }
    
    if (empty($prenom)) {
        $errors[] = 'Le prénom est obligatoire';
    }
    
    if (empty($email)) {
        $errors[] = "L'email est obligatoire";
        // test de la validité de l'adresse email (format)
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email n'est pas valide";
    }
    
    if (empty($ville)) {
        $errors[] = 'La ville est obligatoire';
    }
    
    if (empty($cp)) {
        $errors[] = 'Le code postal est obligatoire';
        // ctype_digit teste qu'un string ne contienne que des chiffres
    } elseif (strlen($cp) != 5 || !ctype_digit($cp)) {
        $errors[] = "Le code postal n'est pas valide";
    }
    
    if (empty($adresse)) {
        $errors[] = "L'adresse est obligatoire";
    }
    
    if (empty($mdp)) {
        $errors[] = 'Le mot de passe est obligatoire';
    } elseif (!preg_match('/^[a-zA-Z0-9_-]{6,20}$/', $mdp)) {
        $errors[] = "Le mot de passe doit faire entre 6 et 20 caractères et ne contenir que des chiffres, des lettres ou les caractères _ et -";
    }
    
    if ($mdp != $mdp_confirm) {
        $errors[] = 'Le mot de passe et sa confirmation ne sont pas identiques';
    }
    
    if (empty($errors)) {
        
        if (!empty($_GET['id'])) {
            $query = <<<SQL
UPDATE utilisateur SET
    civilite = :civilite,                
    nom = :nom,
    prenom = :prenom,
    email = :email,
    mdp = :mdp,
    adresse = :adresse,
    cp = :cp,
    ville = :ville,                
WHERE id = :id
SQL;
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':civilite' => $civilite,
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':email' => $email,
                ':mdp' => password_hash($mdp, PASSWORD_BCRYPT),
                ':adresse' => $adresse,
                ':cp' => $cp,
                ':ville' => $ville,
                ':id' => $id
            ]);
        } else {
            $query = <<<SQL
INSERT INTO utilisateur (
    civilite,                
    nom,
    prenom,
    email,
    mdp,
    adresse,
    cp,
    ville
) VALUES (
    :civilite,
    :nom,
    :prenom,
    :email,
    :mdp,
    :adresse,
    :cp,
    :ville
)
SQL;
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':civilite' => $civilite,
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':email' => $email,
                ':mdp' => password_hash($mdp, PASSWORD_BCRYPT),
                ':adresse' => $adresse,
                ':cp' => $cp,
                ':ville' => $ville,
            ]);
        }
        
        setFlashMessage('Le membre a été modifié');
        header('Location: membres.php');
        die;
   }
} elseif (!empty($_GET['id'])) {
    $query = 'SELECT * FROM utilisateur WHERE id = ' . (int)$_GET['id'];
    $stmt = $pdo->query($query);
    $utilisateur = $stmt->fetch();
    extract($utilisateur);
}

require __DIR__ . '/../layout/top.php';

if (!empty($errors)) :
?>
    <div class="alert alert-danger">
        <h5 class="alert-heading">
            Le formulaire contient des erreurs
        </h5>
        <?= implode('<br>', $errors); ?>
    </div>
<?php
endif;
?>

<h1>Modification membre</h1>

<form method="post">
    <div class="form-group">
        <label>Civilité</label>
        <select name="civilite" class="form-control">
            <option value=""></option>
            <option value="Mme" <?php if($civilite == 'Mme') {echo 'selected';} ?> >Mme</option>
            <option value="Mr" <?php if($civilite == 'Mr') {echo 'selected';} ?> >Mr</option>
        </select>
    </div>
    <div class="form-group">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" value="<?= $nom; ?>" placeholder="<?= $nom; ?>">
    </div>
    <div class="form-group">
        <label>Prénom</label>
        <input type="text" name="prenom" class="form-control" value="<?= $prenom; ?>">
    </div>
    <div class="form-group">
        <label>email</label>
        <input type="text" name="email" class="form-control" value="<?= $email; ?>">
    </div>
    <div class="form-group">
        <label>Ville</label>
        <input type="text" name="ville" class="form-control" value="<?= $ville; ?>">
    </div>
    <div class="form-group">
        <label>Code postal</label>
        <input type="text" name="cp" class="form-control" value="<?= $cp; ?>">
    </div>
    <div class="form-group">
        <label>Adresse</label>
        <textarea name="adresse" class="form-control"><?= $adresse; ?></textarea>
    </div>
    <div class="form-group">
        <label>Mot de passe</label>
        <input type="password" name="mdp" class="form-control">
    </div>
    <div class="form-group">
        <label>Confirmation du Mot de passe</label>
        <input type="password" name="mdp_confirm" class="form-control">
    </div>
    <div class="form-btn-group text-right">
        <button class="btn btn-info">
            Valider
        </button>
    </div>
</form>

<?php
require __DIR__ . '/../layout/bottom.php';
?>