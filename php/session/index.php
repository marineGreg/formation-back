<?php
// $_SESSION n'existe que si l'on initialise la session avec cette fonction
session_start();

// ajout d'éléments dans la session
$_SESSION['prenom'] = 'Julien';
$_SESSION['nom'] = 'Anest';

var_dump($_COOKIE);
echo '<br>';
var_dump($_SESSION);

?>