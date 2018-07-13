<?php
// faire la page qui liste les produits dans un tableau HTML
// tous les champs sauf la description
// bonus: afficher le nom de la catégorie au lieu de son id
require_once __DIR__ . '/../include/init.php';
adminSecurity();

$stmt = $pdo->query('SELECT c.nom as nom_categorie, p.id, p.nom, p.reference,'
        . ' p.prix FROM categorie c JOIN produit p ON p.categorie_id = c.id');
$produits = $stmt->fetchAll();


require __DIR__ . '/../layout/top.php';
?>
    <h1>Gestion produits</h1>
    
    <p><a href="produit-edit.php">Ajouter un produit</a></p>
    
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NOM</th>
      <th scope="col">REFERENCE</th>
      <th scope="col">PRIX</th>
      <th scope="col">CATEGORIE</th>
      <th width="250px"></th>
    </tr>
  </thead>
  <tbody>
<?php
    foreach ($produits as $produit) :
?>
      <tr>
          <td><?= $produit['id']; ?></td>
          <td><?= $produit['nom']; ?></td>
          <td><?= $produit['reference']; ?></td>
          <td><?= prixFr($produit['prix']); ?></td>
          <td><?= $produit['nom_categorie'] ?></td>
          <td>
            <a href="produit-edit.php?id=<?= $produit['id']; ?>" 
               class="btn btn-info">
                  Modifier
            </a>
            <a href="produit-delete.php?id=<?= $produit['id']; ?>" 
               class="btn btn-outline-danger">
                  Supprimer
            </a>
          </td>
      </tr>
<?php
  endforeach;
?>
  </tbody>
</table>
    
<?php
require __DIR__ . '/../layout/bottom.php';
?>