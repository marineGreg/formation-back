<h2>Connexion</h2>
<?php
// pdo : php data object
$pdo = new PDO(
    'mysql:host=localhost;dbname=entreprise', // chaîne de connexion
    'root', // utilisateur
    '', // mot de passe
    // Tableau d'options de connexion à la BDD
    [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);
?>

<h2>Select $ fetch (1 résultat)</h2>
<?php
$stmt = $pdo->query('SELECT * FROM employe WHERE id = 1');
var_dump($stmt); // objet PDOStatement

$employe = $stmt->fetch();
echo '<br><pre>';
var_dump($employe);
echo '</pre>';
echo $employe['prenom'] . ' ' . $employe['nom'];
?>

<h2>Select & fetch (plusieurs résultats)</h2>
<?php
$stmt = $pdo->query('SELECT * FROM employe LIMIT 3');
/**
 * Chaque appel à la méthode fetch retourne le résultat suivant
 * quand il n'y a plus de résultat, ça retourne false, on sort de la boucle
 */
while ($employe = $stmt->fetch()) {
    echo $employe['prenom'] . ' ' . $employe['nom'] . '<br>';
}
?>

<h2>Select & fetchAll</h2>
<?php
$stmt = $pdo->query('SELECT nom, prenom FROM employe LIMIT 3');
$employes = $stmt->fetchAll(); // tableau multi-dimensionnel
echo '<pre>';
var_dump($employes);
echo '</pre>';

// afficher prénom et nom des employés
foreach ($employes as $employe) {
	echo $employe['prenom'] . ' ' . $employe['nom'] . '<br>';
}
?>


<h2>Insert, update, delete</h2>
<?php
// query() pour les requêtes SELECT, exec() pour les autres
$result =$pdo->exec( 'UPDATE employe SET salaire = 5000 WHERE id = 1');
var_dump($result); // le nombre de lignes modifiées
/* $query = <<<EOS
    INSERT INTO employe (
        nom,
        prenom,
        service,
        date_embauche,
        salaire
    ) VALUES (
        'Marx',
        'Groucho',
        'informatique',
        '2018-07-04',
        5000
    )
EOS;
$pdo->exec($query);
echo $pdo->lastInsertId();
*/
?>

<h2>Select & fetchColumn</h2>
<?php
$stmt = $pdo->query('SELECT count(*) AS nb FROM employe');
var_dump($stmt->fetchColumn()); // 1er résultat de la 1ère ligne
?>

<h2>Quote</h2>
<?php
$nom = "D'artagnan"; // erreur de syntaxe à cause de la quote
// $query = "SELECT * FROM employe WHERE nom = '$nom'";
// quote() met la chaîne entre quotes et échappe celles qui se trouvent à l'intérieur de la chaîne
$query = 'SELECT * FROM employe WHERE nom = ' . $pdo->quote($nom);
echo $query;
$stmt = $pdo->query($query);
var_dump($stmt->fetch());
?>

<h2>Requêtes préparées</h2>
<?php
$query = 'SELECT * FROM employe WHERE service = ?';
$stmt = $pdo->prepare($query); // envoie la requête au SGBD pour préparation
$stmt->bindValue(1,'informatique'); // donne une valeur au 1er point d'interrogation dans la requête
$stmt->execute(); // exécute la requête avec la valeur donnée par bindValue()
$employes = $stmt->fetchAll();
echo '<pre>';
var_dump($employes);
echo '</pre>';
?>

<h2>Requêtes préparées (paramètres nommées)</h2>
<?php
// les paramètres dans la requête sont préfixés par ':'
$query = 'SELECT * FROM employe WHERE service = :service';
$stmt = $pdo->prepare($query);
$stmt->bindValue(':service','informatique'); 
$stmt->execute(); 
$employes = $stmt->fetchAll();
echo '<pre>';
var_dump($employes);
echo '</pre>';

$query = 'UPDATE bibliotheque.emprunt SET date_rendu = :date WHERE id_emprunt = 1';
$stmt = $pdo->prepare($query);
// si la valeur est nulle, il fauit le préciser en 3è paramètre
$stmt->bindValue(':date', null, PDO::PARAM_NULL);
$stmt->execute();
?>

<h2>Requêtes préparées avec bindParam</h2>
<?php
$query = 'SELECT * FROM employe WHERE service = :service AND salaire > :salaire';
$stmt = $pdo->prepare($query);
$stmt->bindValue(':service','informatique');
$stmt->bindValue(':salaire',4000); 
$stmt->execute(); 
$employes = $stmt->fetchAll();
echo '<pre>';
var_dump($employes);
echo '</pre>';
// on peut lier les paramètres directement dans le execute()
// remplace les appels à bindValue()
$stmt->execute([
    ':service' => 'commercial',
    ':salaire' => 4500
]);
?>

<h2>Requêtes préparées avec bindParam</h2>
<?php
$query = 'SELECT * FROM employe WHERE service = :service AND salaire > :salaire';
$stmt = $pdo->prepare($query);
// Avec bindParam() le 2ème paramètre est passé par référence, ce doit donc être une variable 
$service = 'informatique';
$salaire = 4000;
$stmt->bindParam(':service', $service);
$stmt->bindParam(':salaire', $salaire);
$stmt->execute();
$employes = $stmt->fetchAll();
echo '<pre>';
var_dump($employes);
echo '</pre>';

// En changeant la valeur de la variable, un nouvel execute() appelle la requête avec sa nouvelle valeur
$service = 'commercial';
$stmt->execute();
$employes = $stmt->fetchAll();
echo '<pre>';
var_dump($employes);
echo '</pre>';