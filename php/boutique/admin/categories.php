<?php
require_once __DIR__ . '/../include/init.php';
adminSecurity();

// lister les catégories dans un tableau HTML

$stmt = $pdo->query('SELECT * FROM categorie');
$categories = $stmt->fetchAll();

require __DIR__ . '/../layout/top.php';
?>
    <h1>Gestion des catégories</h1>
    
    <p><a href="categorie-edit.php">Ajouter une catégorie</a></p>
    
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NOM</th>
      <th width="250px"></th>
    </tr>
  </thead>
  <tbody>
<?php
    foreach ($categories as $categorie) :
?>
      <tr>
          <td><?= $categorie['id']; ?></td>
          <td><?= $categorie['nom']; ?></td>
          <td>
              <a href="categorie-edit.php?id=<?= $categorie['id']; ?>" 
                 class="btn btn-info">
                  Modifier
              </a>
              <a href="categorie-delete.php?id=<?= $categorie['id']; ?>" 
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