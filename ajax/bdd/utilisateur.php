<?php
require_once __DIR__ . '/cnx.php';

// echo 'Id reçu : ' . $_GET['id'];

$query = 'SELECT * FROM utilisateur WHERE id = ' . $_GET['id'];
$stmt = $pdo->query($query);
$utilisateur = $stmt->fetch();
?>

<!-- Construction du HTML qui va être la réponse dans le traitement côté javascript -->
<dl>
    <dt>Nom</dt>
    <dd><?= $utilisateur['nom']; ?></dd>
    <dt>Prénom</dt>
    <dd><?= $utilisateur['prenom']; ?></dd>
    <dt>Adresse</dt>
    <dd>
        <?= $utilisateur['adresse']; ?><br>
        <?= $utilisateur['cp'] . ' ' . $utilisateur['ville']; ?>
    </dd>
    <dt>email</dt>
    <dd><?= $utilisateur['email']; ?></dd>
    <dt>Téléphone</dt>
    <dd><?= $utilisateur['tel']; ?></dd>
</dl>