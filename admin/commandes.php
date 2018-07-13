<?php

/* 
 * lister les commandes dans un tableau
 * - id de la commande
 * - nom prénom de l'utilisateur qui a passé la commande
 * - montant formaté
 * - date de la commande
 * - statut
 * - date du statut
 * passer le statut en liste déroulante avec un bouton Modifier pour changer
 * le statut de la commande en bdd (nécessité d'un champ caché pour récupérer
 * l'id de la commande)
 */

require_once __DIR__ . '/../include/init.php';
adminSecurity();

if (isset($_POST['modifierStatut'])) {
    $query = <<<SQL
        UPDATE commande
        SET statut = :statut,
            date_statut = now()
        WHERE id = :id
SQL;
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':statut' => $_POST['statut'],
        ':id' => $_POST['commandeId']
    ]);
    
    setFlashMessage('Le statut est modifié');
}

$query = <<<SQL
        SELECT c.*, concat_ws(' ', u.prenom, u.nom) AS utilisateur 
            FROM commande c 
                JOIN utilisateur u ON c.utilisateur_id = u.id 
                    ORDER BY c.date_commande DESC
SQL;
$stmt = $pdo->query($query);
$commandes = $stmt->fetchAll();

$statuts = [
    'annulé',
    'en cours',
    'envoyé',
    'livré'
];

require __DIR__ . '/../layout/top.php';
?>
    <h1>Gestion commandes</h1>
    
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Utilisateur</th>
      <th scope="col">Montant</th>
      <th scope="col">Date</th>
      <th scope="col">Statut</th>
      <th scope="col">Date MAJ statut</th>
    </tr>
  </thead>
  <tbody>
<?php
    foreach ($commandes as $commande) :
?>
    <tr>
        <td><?= $commande['id']; ?></td>
        <td><?= $commande['utilisateur']; ?></td>
        <td><?= prixFr($commande['montant_total']); ?></td>
        <td><?= datetimeFr($commande['date_commande']); ?></td>
        <td>
            <form method="post" class="form-inline">
                <select name="statut" class="form-control form-control-sm">
                    <option value="<?= $commande['statut']; ?>"><?= $commande['statut']; ?></option>
                    <?php
                    foreach ($statuts as $statut) :
                        $selected = ($statut == $commande['statut'])
                            ? 'selected'
                            : ''
                        ;
                    ?>
                        <option value="<?= $statut; ?>" <?= $selected; ?><>
                            <?= $statut; ?>
                        </option>
                    <?php
                    endforeach;
                    ?>
                </select>
                <input type="hidden" name="commandeId" value="<?= $commande['id']; ?>">
                <button type="submit" class="btn btn-outline-info btn-sm"
                        name="modifierStatut">
                   Modifier
               </button>
            </form>
        </td>
        <td><?= datetimeFr($commande['date_statut']); ?></td>
    </tr>
<?php
  endforeach;
?>
  </tbody>
</table>
    
<?php
require __DIR__ . '/../layout/bottom.php';
?>