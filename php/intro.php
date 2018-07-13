<?php
// un commentaire sur une ligne
/**
 * un commentaire sur plusieurs lignes
 */

 echo 'Hello world'; // echo affiche du texte
 echo '<br><strong>Du texte en gras</strong>';
?>

<h2>Variables</h2>
<?php
$a = 1; // déclaration d'une variable
echo $a; // affiche la valeur de la variable
// $a est de type INTEGER ou INT
$b = 1.5; //$b est de type FLOAT
$c = 'Hello'; // $c est de type STRING
$d= true; //$d est de type BOOLEAN ou BOOL
echo '<br>';
var_dump($d); // pour avoir une information sur une variable  
$e = (int)$d;// pour forcer le type d'une variable (ici en entier):*
?>

<h2>Concaténation</h2>
<?php
$a = 'Hello';
$b = ' world';
echo $a . $b; // le point sert à concaténer
echo '<br>'. $a . ' to the' . $b;
$c = 2;
// devient la chaine "un plus un font 2"
$d = 'Un plus un font ' . 2;
echo '<br>' . $d;
?>

<h2>Guillemets</h2>
<?php
$a = 'Bonjour';
echo '$a le monde'; // $a n'est pas remplacé par sa valeur
echo "<br> $a le monde"; // dans une chaîne entre guillemets double les variables sont interprétées
?>

<h2>Constantes</h2>
<?php
// déclaration d'une constante qui s'appelle VILLE et qui vaut PARIS
define('VILLE', 'Paris');
echo VILLE;
echo '<br>';

/**
 * Les constantes magiques sont données par le langage et changent de valeur en fonction du contexte elles sont préfixées et suffixées par 2 underscores
 */
// le fichier dans lequel on se trouve
echo __FILE__; 
// la ligne à laquelle on se trouve
echo '<br>' . __LiNE__;
// le répertoire dans lequel on se trouve
echo '<br>' . __DIR__;
?>

<h2>Opérateurs arithmétiques</h2>
<?php
$a = 2;
$b = 6;
echo $a + $b;
echo '<br>';
echo $a - $b;
echo '<br>';
echo $a * $b;
echo '<br>';
echo $b / $a;
echo '<br>';
echo $b % $a; // modulo : reste de la division
// si le reste vaut 0, le 1er nombre est divisible par le 2ème
echo '<br>';
$a += $b; // $a = $a +$b
$a = 'Bonjour';
$b = ' le monde';
$a .= $b; // $a = $a . $b
echo $a; // 'bonjour le monde'

$i = 0;
$i++; // $i += 1 ou $i = $i +1
echo '<br>' . $i; // 1
$i++;
echo '<br>' . $i; // 2 ...
?>

<h2>Conditions</h2>
<?php
$vrai = true;

/**
 * le code à l'intérieur des accolades s'execute si le contenu entre parenthèses est évalué en booléen à true
 */
if ($vrai) {
    echo '$vrai est vrai';
}

$faux = false;

if ($faux) {
    // on n'entre pas dans la condition
    echo '$faux est vrai';
} else { // le code qui s'exécute si on n'entre pas dans le if
    echo '$faux est faux';
}

echo '<br>';

if ($faux) {
    // on n'entre pas dans la condition
    echo '$faux est vrai';
    // si on n'est pas entré dans le if et que $vrai est vrai
} elseif ($vrai) {
    echo '$faux est faux et $vrai et vrai';
} else { // le code qui s'exécute si on n'entre ni dans le if ni dans le elseif
    echo '$faux est faux';
}
// on peut mettre autant de elseif qu'on veut qui vont être évalués successivement

$str = 'test' ;

if ($str == 'test') {// teste l'égalité de valeur
    echo ('$str vaut test');
}

if ($str != 'bonjour') {// teste l'inégalité de valeur
    echo ('$str ne vaut pas bonjour');
}

echo '<br>';
$a = 10; // INTEGER
$b = '10'; // STRING

var_dump ($a == $b); // vrai : même valeur

echo '<br>';

var_dump ($a === $b); // faux : même valeur mais pas le même type

// operateur inverse
var_dump($a !== $b);

$a = 1;
$b = 2;

echo '<br>';
var_dump($a > $b); // $a supérieur à $b
echo '<br>';
var_dump($a < $b); // $a inférieur à $b
echo '<br>';
var_dump($a >= $b); // $a supérieur ou égal à $b (faux)
echo '<br>';
var_dump($a <= $b); // $a inférieur ou égal à $b (vrai)

// si $a est défini (set et n'est pas null)
if (isset($a)) {
    echo '$a existe et n\'est pas null';
}

echo '<br>';

if (!empty($a)) {
    echo '$a existe et n\'est pas vide';
}
// sont vides : null, 0, 0.0, false, '0', '', un tableau vide

$a = 1;
$b = 2;
$c = 3;
$d = 4;

// ET logique : &&
if ($b > $a && $c > $b) {
    echo '$b > $a ET $c > $b';
}

// OU logique : ||
if ($b > $a || $c > $b) {
    echo '$b > $a ET $c > $b';
}

// OU exclusif : XOR
if ($b > $a XOR $c > $b) {
    echo '$b > $a OU $c > $b MAIS PAS les 2 à la fois'; 
}

// priorité du ET sur le OU
if ($b > $a || $c > $b && $c > $d) {
    echo '$b > $a OU ($c > $b ET $c > $d)';
}

// les parenthèses pour forcer la priorité sur le OU
if ($b > $a || $c > $b && $c > $d) {
    echo '$b > $a OU ($c > $b ET $c > $d)';
}
?>

<h2>Switch</h2>
<?php
$couleur = 'bleu';

// test successivement plusieurs valeurs pour la variable $couleur
switch ($couleur) {
    case 'rouge':
        echo 'La couleur est rouge';
        break;
        case 'bleu':
        echo 'La couleur est bleu';
        break; // le code s'exécute jusqu'au prochain break
        case 'jaune':
        echo 'La couleur est jaune';
        break;
    default: // optionnel
        echo 'La couleur est inconnue';
}
// refaire ce switch avec une structure conditionnelle
if ($couleur == 'rouge') {
	echo 'La couleur est rouge';
} elseif ($couleur == 'bleu') {
	echo 'La couleur est bleu';
} elseif ($couleur == 'jaune') {
	echo 'La couleur est jaune';
} else {
	echo 'La couleur est inconnue';
}
?>

<h2>Opérateur ternaire</h2>
<?php
$a = 1;

$b = ($a == 1) // condition
	? '$a vaut 1' // si vrai
	: '$a ne vaut pas 1' // si faux
;
// équivaut à :
if ($a == 1) {
	$b = '$a vaut 1';
} else {
	$b = '$a ne vaut pas 1';
}
?>

<h2>Boucle WHILE</h2>
<?php
$i = 0;

// tant que $i est inférieur à 3
while ($i < 3) {
	// le code à l'intérieur d'une boucle
	// peut contenir des conditions ou d'autres boucles
	if ($i == 2) {
		echo '@';
	} else {
		echo '#';
	}

	echo $i; // on affiche la valeur de $i
	$i++; // on incrémente $i de 1
}
echo '<br>A la fin, $i vaut ' . $i; // 3
echo '<br>';

$j = 1;

while ($j < 5) {
	// si $j est divisible par 3
	if ($j % 3 == 0) {
		echo 'fin';
		break; // le break arrête net l'exécution de la boucle
	}

	echo $j;
	$j++;
}
?>

<h2>Boucle FOR</h2>
<?php
// équivalent de la 1ère boucle WHILE ci-dessus
// valeur initiale; condition d'arrêt; incrémentation
for ($i = 0; $i < 3; $i++) {
	if ($i == 2) {
		echo '@';
	} else {
		echo '#';
	}

	echo $i;
}
echo '<br>';
/*
 construire une liste déroulante HTML (select)
 pour choisir le jour du mois, donc de 1 à 31

 <select>
	<option value="1">1</option>
	<option value="2">2</option>
	...
 </select>
*/
echo '<select>';

for ($i = 1; $i <= 31; $i++) {
	echo '<option value="' . $i . '">' . $i . '</option>';
	// avec un chaîne en double quote :
	// echo "<option value=\"$i\">$i</option>";
}

echo '</select>';

// construire un tableau HTML d'une ligne sur 8 cases
/*
<table> 
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	<tr>
</table>
*/
echo '<table border="1"><tr>';
for ($i = 1; $i <= 8; $i++) {
	echo "<td>$i</td>";
}
echo '</tr></table>';

// faire un tableau de 8 lignes sur 8 colonnes
// implique une bouble dans une boucle : boucle imbriquée
echo '<table border="1">';
for ($i = 1; $i <= 8; $i++) {
	echo '<tr>';
	for ($j = 1; $j <= 8; $j++) {
		echo "<td>$i - $j</td>";
	}
	echo '</tr>';
}
echo '</table>';

// pour faire un damier :
echo '<table border="1">';
for ($i = 1; $i <= 8; $i++) {
	echo '<tr>';
	for ($j = 1; $j <= 8; $j++) {
		$style = (($i + $j) % 2 == 0)
			? 'style="background-color: grey"'
			: ''
		;
		echo '<td ' . $style . '>' . ($i + $j) . '</td>';
	}
	echo '</tr>';
}
echo '</table>';
?>
<h2>Array</h2>
<?php
$tab = array(); // crée un tableau vide
$tab = []; // même chose en notation courte
$tab = array('a', 2, true); // un tableau de 3 éléments
$tab = ['a', 2, true]; // même chose en notation courte
var_dump($tab);
$tab[] = 'b'; // ajout d'un élément au tableau
var_dump($tab[0]); // valeur du 1er élément du tableau (indice 0)
$tab[1] = 3; // remplace la valeur du 2e élément (indice 1)
// même tableau en spécifiant explicitement les clés
$tab = [
	0 => 'a',
	1 => 2,
	2 => true
];
// tableau associatif avec des clés en chaînes de caractères
$assoc = [
	'a' => 'A',
	'b' => 'B',
	'c' => 'C'
];
var_dump($assoc['a']); // valeur de l'element avec la clé 'a'
// ajout d'un élément en spécifiant la clé
$assoc['d'] = 'D';
// si on y ajoute un élément sans préciser la clé, il prend l'indice 0
$assoc[] = 'E';
echo '<br>';
var_dump($assoc);
$assoc[5] = 'F'; // ajoute un élément avec l'indice 5
$assoc[] = 'G'; // ajoute un élément avec l'indice 6 (le plus grand indice numérique + 1)
$assoc['5'] = 'H';
echo '<br>';
var_dump($assoc);

$test = 'test';
unset($test); // supprime une variable

unset($assoc['c']); // supprime l'élément du tableau qui a l'indice 'c'
?>
<h2>Boucle FOREACH</h2>
<?php
/*
$value est une variable créée dans la déclaration
du foreach pour faire référence dans la boucle
à l'élément sur lequel on est en train de boucler
*/
foreach ($tab as $value) {
	var_dump($value);
	echo '<br>';
}

// même chose en ayant en plus l'information de la clé dans la boucle
foreach ($assoc as $key => $value) {
	echo $key . ' : ' . $value . '<br>';
}

// ne modifie pas la valeur dans le tableau ($value est une copie)
foreach ($assoc as $value) {
	if ($value == 'A') {
		$value = 'Z';
	}
}

echo '<br>';
var_dump($assoc);

// pour modifier la valeur à l'intérieur de la boucle :
foreach ($assoc as $key => $value) {
	if ($value == 'A') {
		$assoc[$key] = 'Z';
	}
}

echo '<br>';
var_dump($assoc);
?>
<h2>Tableau multi-dimentionnel</h2>
<?php
$users = [
	[
		'prenom' => 'Julien',
		'nom' => 'Anest'
	],
	[
		'prenom' => 'Liam',
		'nom' => 'Tardieu'
	]
];

// faire une boucle foreach qui affiche nom prenom des 2 users à la ligne
foreach ($users as $user) {
    echo $user['prenom'] . ' ' . $user['nom'] . '<br>';
}

// affiche le prénom du 2ème user
echo $users[1]['prenom'];
?>

<h2>Fonctions prédéfinies</h2>
<?php
echo strlen('toto'); // affiche 4
echo '<br>';
// Affiche date et heure actuelle au format français
echo date('d/m/Y H:i:s');
?>

<h2>Fonctions utilisateur</h2>
<?php

// déclaration d'une fonction
function separateur()
{
    echo '<hr>';
}

// appel de la fonction
separateur();

// fonction prenant un paramètre
function bonjour($qui)
{
    echo "Bonjour $qui<br>";
}
// $qui dans l'exécution de la fonction vaut "Julien"
bonjour('Julien');
$nom = 'Liam';
// $qui dans l'exécution de la fonction vaut "Liam"
bonjour($nom);
// $qui n'existe pas en dehors de la fonction
//var_dump($qui);

function test()
{   
    // $nom dait partie du scope global et n'est pas accessible dans la fonction
    // var_dump($nom);
}

test();

function hello($prenom, $nom = '')
{
	$str = "Bonjour $prenom";

	if (!empty($nom)) {
		$str .= " $nom";
	}

	echo $str;
}

// la valeur de $nom dans la fonction sera 'Anest'
hello('Julien', 'Anest');
echo '<br>';
// la valeur de $nom dans la fonction sera '' (la valeur par défaut)
hello('Julien');
echo '<br>';

// la fonction renvoie une valeur
function foisDix($nombre)
{
	return $nombre * 10;
}

$nb = foisDix(5);
var_dump($nb); // $nb contient ce que retourne la fonction 

function refuseDix($nombre)
{
	if ($nombre == 10) {
		return 'ko'; // si le nombre est 10, l'exécution de la fonction s'arrête là
	}
	return 'ok';
}
echo '<br>';

// faire une fonction pour un calcul de TVA qui prend un montant HT (obligatoire) et un taux (optionnel, par défaut 20) et qui retourne le montant TTC

function calculTTC($montantHT, $taux = 20) 
{
		$montantTTC = $montantHT + $montantHT * $taux / 100;
		return $montantTTC . '€ TTC';
}

// calcul le montantTTC à partir d'un taux de 20% (avec la valeur par défaut)
$ttc = calculTTC(100);
echo '<br>' . $ttc;

// calcule le montantTTC à partir d'un taux de 5%
$ttc = calculTTC(100, 5);
echo '<br>' . $ttc;
?>

<h2>Référence</h2>
<?php
$a = 1;
$b = $a; // on affecte la valeur de $a et $b
$a++; // quand on modifie $a, ça ne modifie pas $b
var_dump($a, $b);

$c = 1;
$d = &$c; // $d fait référence $c
$c++; 	  // quand on modifie $c, ça modifie $d
echo '<br>';
var_dump($c, $d);
$d++;	  // quand on modifie $d, ça modifie $c
echo '<br>';
var_dump($c, $d);

function ajoute1($nb)
{
	// $nb contient la valeur qu'on passe au moment de l'appel mais ne fait pas référence à $nombre
	$nb++;
}
$nombre = 1;
ajoute1($nombre);
var_dump($nombre);  // $nombre n'est pas modifié

// le paramètre $nb fait référence à la variable qu'on lui passe au moment de l'appel
function ajoute2(&$nb)
{
	$nb += 2;
}

// parce que le paramètre est passé par référence, la valeur de $nombre est modifiée
ajoute2($nombre);

ajoute1(1); // on peut passer directement une valeur
// ajoute2(1); fatal error, il faut forcément passer une variable
?>

<h2>Variables dynamiques</h2>
<?php
$variable = 'bonjour';
$name = 'variable';
echo $$name; // affiche bonjour, éq $variable ($name est remplacé par sa valeur)

$tag1 = 1;
$tag2 = 2;
$tag3 = 3;

for ($i = 1; $i <= 3; $i++) {
	echo ${'tag' . $i} . '<br>'; // $tag1 au premier tour de boucle 
}
?>

<h2>Tableau et guillemets doubles</h2>
<?php
$array = ['nom' => 'Julien'];
// echo "Bonjour $array['nom']}"; ne fonctionne pas avec un élément de tableau
echo "Bonjour ${array['nom']}";
?>

<h2>Objet</h2>
<?php

class Personne
{
	// attributs de la class (variables internes)
	public $prenom;
	public $nom;

	// méthodes de la classe (fonctions internes)

	// méthodes automatiquement appelées à l'instanciation
	public function __construct($nom, $prenom)
	{
		$this->prenom = $prenom;
		$this->nom = $nom;
	}

	public function seNommer()
	{
		return $this->prenom . ' ' .$this->nom;
	}
}
// instanciation de la classe = création d'un objet à partir de la class
// à l'instanciation, la méthode __construct() est appelée
$moi = new Personne('Anest', 'Julien');
echo $moi->nom; // affiche la valeur de l'attribut
echo '<br>' . $moi->seNommer(); // appel de la méthode seNommer

// créé un objet de la classe interne DateTime de PHP, qui représente date et heure courante
$now = new DateTime();
echo '<br>' . $now->format('d/m/Y H:i:s');
?>

<h2>Inclusion de fichier</h2>
<?php
// inclus le contenu du fichier ici
include 'inclus.php'; // chemin relatif (par rapport au fichier courant)
include 'c:\xampp\htdocs\formation-back\php\inclus.php'; // chemin absolu (à partir de la racine du serveur)
include __DIR__ . '/inclus.php'; // chemin absolu construit à partir du répertoire courant
include __DIR__ . DIRECTORY_SEPARATOR . 'inclus.php'; // en utilisant une constante donnée par le langage

include 'inconnu.php';

// la seule différence entre include et require est le niveau d'erreur en cas d'échec
// include __DIR__ . '/inconnu.php'; // warning
// require __DIR__ . '/inconnu.php'; // fatal error
?>

<h2>Expression régulière</h2>
<?php
var_dump(preg_match('/as/', 'passe')); // contient 'as'
var_dump(preg_match('/^pa/', 'passe')); // commence par 'pa'
var_dump(preg_match('/se$/', 'passe')); // finit par 'se'
var_dump(preg_match('/[pb]/', 'passe')); // contient un p ou un b
var_dump(preg_match('/a-z/', 'passe')); // contient une lettre minuscule
var_dump(preg_match('/[a-zA-Z]/', 'passe')); // contient une lettre minuscule ou majuscule
var_dump(preg_match('/^[0-9]$/', '5')); // ne contient qu'un chiffre
var_dump(preg_match('/^[0-9]+$/', 'coucou10')); // se termine par un ou plusieurs chiffres
var_dump(preg_match('/^[0-9]*$/', 'coucou10')); // se termine par aucun, un ou plusieurs chiffres
var_dump(preg_match('/^[0-9]?$/', 'coucou1')); // se termine par aucun ou un chiffre
var_dump(preg_match('/^[0-9]+.*[0-9]+$/', '0coucou1000')); // commence par 1 ou plusieurs chiffres, se termine par un ou plusieurs chiffres et entre les deux, aucun, un ou plusieurs caractères, n'importe lesquels (.*)
var_dump(preg_match('/^[a-z]{1,3}$/', 'pi')); // une chaîne de lettres minuscules de 1 à 3 caractères
var_dump(preg_match('/^[a-z_-]+$/', 't-e-s-t')); // une chaîne minuscule qui peut contenir _ et - (le tiret doit être en dernière position dans les crochets)
var_dump(preg_match('/^[0-9]+$/', 'X', 'Juillet 2018')); // remplace tous les chiffres par X
?>

<h2>Syntaxe alternative</h2>
<?php
// syntaxe généralement utilisée dans les templates
// les accolades ouvrantes sont remplacées par deux points 
// les accolades fermantes sont remplacées par end [nom de l'instruction] (ex: endfor, endwhile, etc.)
if (10 < 20) : 
	echo 'ici';
else : 
	echo 'là';
endif;