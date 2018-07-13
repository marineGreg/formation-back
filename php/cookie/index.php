<?php
if (isset($_GET['langue'])) {
    $langue = $_GET['langue'];
    $unAn = 365 * 24 * 60 * 60; // un an en secondes
    /**
     * 1er paramètre : nom du cookie
     * 2è : sa valeur
     * 3è : timestamp d'expiration => time() donne le timestamp actuel
     */
    setcookie('langue', $langue, time() + $unAn);
} elseif (isset($_COOKIE['langue'])) {
    $langue = $_COOKIE['langue'];
} else {
    $langue = 'fr';
}
?>
<p>
    Votre langue : 
</p>
<ul>
    <li><a href="index.php?langue=fr">Français</a></li>
    <li><a href="index.php?langue=en">Anglais</a></li>
    <li><a href="index.php?langue=es">Espagnol</a></li>
</ul>
<h1>
<?php
switch ($langue) {
    case 'en':
        echo 'Hello';
        break;
    case 'es':
        echo 'Hola';
        break;
    default:
        echo 'Bonjour';
}
?>
</h1>