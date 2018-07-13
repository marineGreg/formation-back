<?php
// $_GET est un tableau associatif qui existe toujours et qui contient les informations de la query string
var_dump($_GET);

echo '<br>';
echo $_GET['prenom'] . ' ' . $_GET['nom'];

function test() 
{   
    // les super globales comme $_GET sont aussi accessibles dans le scope des fonctions
    var_dump($_GET);
}

echo '<br>';
test();