<?php

/**
 * - afficher le nom de la catégorie dont on a reçu l'id dans l'URL en titre de la page
 * - lister les produits appartenant à la catégorie avec leur photo s'ils en ont une
 */

require_once __DIR__ . '/include/init.php';

$query = 'SELECT nom FROM categorie WHERE id = ' . (int)$_GET['id'];
$stmt = $pdo->query($query);
$titre = $stmt->fetchColumn();

$query2 = 'SELECT * FROM produit where categorie_id = ' . (int)$_GET['id'];
$stmt2 = $pdo->query($query2);
$produits = $stmt2->fetchAll();


require __DIR__ . '/layout/top.php';
?>
    <h1><?= $titre; ?></h1>
    
    <div class="card-deck">
        <?php
        foreach ($produits as $produit) :
            $src = (!empty($produit['photo']))
                ? PHOTO_WEB . $produit['photo']
                : PHOTO_DEFAULT
            ;
        ?>
        <div class="card">
            <img src="<?= $src ?>" alt="" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title text-center" ><?= $produit['nom']; ?></h5>
                <p class="card-text text-center">
                    <?= prixFr($produit['prix']); ?>
                </p>
            </div>
            <div class="card-footer">
                <p class="card-text text-center">
                    <a href="produit.php?id=<?= $produit['id']; ?>" 
                       class="btn btn-info">
                        Voir
                    </a>
                </p>
            </div>
        </div>
        
        <?php
        endforeach;
        ?>
    </div>
    
<?php
require __DIR__ . '/layout/bottom.php';
?>