<?php

require_once __DIR__ . '/../include/init.php';
adminSecurity();

$query = "SELECT *, concat_ws(' ', prenom, nom) AS utilisateur FROM utilisateur";
$stmt = $pdo->query($query);
$utilisateurs = $stmt->fetchAll();

require __DIR__ . '/../layout/top.php';
?>
    <h1>Gestion des membres</h1>
    
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Utilisateur</th>
      <th scope="col">email</th>
      <th scope="col">Adresse</th>
      <th scope="col">Code Postal</th>
      <th scope="col">Ville</th>
      <th width="250px"></th>
    </tr>
  </thead>
  <tbody>
<?php
    foreach ($utilisateurs as $utilisateur) :
?>
    <tr>
        <td><?= $utilisateur['id']; ?></td>
        <td><?= $utilisateur['utilisateur']; ?></td>
        <td><?= $utilisateur['email']; ?></td>
        <td><?= $utilisateur['adresse']; ?></td>
        <td><?= $utilisateur['cp']; ?></td>
        <td><?= $utilisateur['ville']; ?></td>
        <td>
            <a href="membre-edit.php?id=<?= $utilisateur['id']; ?>" 
               class="btn btn-info btn-sm">
                  Modifier
            </a>
            <a href="membre-delete.php?id=<?= $utilisateur['id']; ?>" 
               class="btn btn-outline-danger btn-sm">
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