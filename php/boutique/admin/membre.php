<?php

require_once __DIR__ . '/../include/init.php';
adminSecurity();

$query = "SELECT concat_ws(' ', prenom, nom) AS utilisateur FROM utilisateur WHERE id = " . (int)$_GET['id'];
$stmt = $pdo->query($query);
$titre = $stmt->fetchColumn();

$query2 = 'SELECT * FROM utilisateur where id = ' . (int)$_GET['id'];
$stmt2 = $pdo->query($query2);
$utilisateurs = $stmt2->fetchAll();

$query3 = "SELECT c.*, concat_ws(' ', u.prenom, u.nom) AS utilisateur FROM utilisateur"
        . " u JOIN commande c ON c.utilisateur_id = u.id WHERE u.id = " . (int)$_GET['id'];
$stmt3 = $pdo->query($query3);
$commandes = $stmt3->fetchAll();


require __DIR__ . '/../layout/top.php';
?>
    
    <div class="card-deck">
        <?php
        foreach ($utilisateurs as $utilisateur) :
            $src = (!empty($produit['photo']))
                ? PHOTO_WEB . $produit['photo']
                : PHOTO_DEFAULT
            ;
        ?>
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center" >
                        <?= $utilisateur['civilite'] . ' ' . $titre ?>
                    </h2>
                    <h4 class="card-text text-center">
                        <?= $utilisateur['pseudo']; ?>
                    </h4>
                    <p class="card-text text-center">
                        <?= $utilisateur['adresse']; ?>
                    </p>
                    <p class="card-text text-center">
                        <?= $utilisateur['cp']; ?>
                        <?= $utilisateur['ville']; ?>
                    </p>
                    <p class="card-text text-center">
                        <?= $utilisateur['email']; ?>
                    </p>
                </div>
                <div class="card-footer">
                    <table class="table table-striped">
                        <h3>Commandes</h3>
                        <thead>
                            <tr>
                              <th scope="col">ID</th>
                              <th scope="col">Montant</th>
                              <th scope="col">Date</th>
                              <th scope="col">Statut</th>
                            </tr>
                          </thead>
                          <tbody>
                        <?php
                            foreach ($commandes as $commande) :
                        ?>
                            <tr>
                                <td><?= $commande['id']; ?></td>
                                <td><?= prixFr($commande['montant_total']); ?></td>
                                <td><?= datetimeFr($commande['date_commande']); ?></td>
                                <td><?= $commande['statut']; ?></td>
                            </tr>
                        <?php
                            endforeach;
                        ?>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
    
<?php
require __DIR__ . '/../layout/bottom.php';
?>