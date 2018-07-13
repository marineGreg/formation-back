<?php

require_once __DIR__ . '/include/init.php';

$query = 'SELECT * FROM produit where id = ' . (int)$_GET['id'];
$stmt = $pdo->query($query);
$produit = $stmt->fetch();

$src = (!empty($produit['photo']))
                ? PHOTO_WEB . $produit['photo']
                : PHOTO_DEFAULT
            ;

if(!empty($_POST)) {
    // ajouter au panier
    ajoutPanier($produit, $_POST['quantite']);
    setFlashMessage('Le produit a est ajouté à votre panier');
    // rediriger vers la page sur laquelle on se trouve permet de ne pas renvoyer
    // les infos de formulaire à l'actualisation de la page
    header('Location: produit.php?id=' . $_GET['id']);
    die;
}

require __DIR__ . '/layout/top.php';
?>
    <h1><?= $produit['nom']; ?></h1>
    
    <div class="row">
        <div class="col-md-4 text-center">
           <img height="400px" src="<?= $src; ?>">
           <p><?= prixFr($produit['prix']); ?></p>
           <form method="post" class="form-inline">
               <label>Qté</label>
               <select name="quantite" class="form-control">
                   <?php
                   for ($i = 1; $i <= 10; $i++) :
                   ?>
                   <option value="<?= $i; ?>"><?= $i; ?></option>
                   <?php
                   endfor;
                   ?>
               </select>
               <button type="submit" class="btn btn-outline-info">
                   Ajouter au panier
               </button>
           </form>
        </div>
        <div class="col-md-8">
            <?= nl2br($produit['description']); ?>
        </div>
    </div>
<?php
require __DIR__ . '/layout/bottom.php';
?>