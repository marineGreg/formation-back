<?php
echo '<p> Données reçues en ' . $_SERVER['REQUEST_METHOD'] . '</p>'; 
echo 'Bonjour';

if (!empty($_GET)){
    echo ' ' . $_GET['prenom'] . ' ' . $_GET['nom'];    
} elseif (!empty($_POST)) {
        echo ' ' . $_POST['prenom'] . ' ' . $_POST['nom'];
}