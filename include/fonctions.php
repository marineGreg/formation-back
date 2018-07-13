<?php
function dump($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function sanitizeValue(&$value)
{   
    // trim() supprime les espaces en début et fin de string
    // strip_tags() supprime les balise HTML
    $value = trim(strip_tags($value));
}

$test = '         fsdgrzehgerjtj<br>     ';
sanitizeValue($test); // on va obtenir 'fsdgrzehgerjtj'

function sanitizeArray(array &$array)
{
    // applique la fonction sanitizeValue() sur tous les éléments du tableau
    array_walk($array, 'sanitizeValue');
}

function sanitizePost()
{
    sanitizeArray($_POST);
}

// enregistre un message en session pour affichage "one shot"
function setFlashMessage($message, $type = 'success')
{
    $_SESSION['flashMessage'] = [
        'message' => $message,
        'type' => $type
    ];
}

// affiche un message flash s'il n'y en a un en session
// puis le supprime
function displayFlashMessage()
{
    if (isset($_SESSION['flashMessage'])) {
        $message = $_SESSION['flashMessage']['message'];
        // pour la classe alert-danger du bootstrap
        $type = $_SESSION['flashMessage']['type'] == 'error'
                ? 'danger'
                : $_SESSION['flashMessage']['type']
        ;
        
        echo '<div class="alert alert-' . $type . '">'
        . ' <h5 class="alert-heading">' . $message . '<h5>' . '</div>'
        ;
        // suppression du message dans la session
        // pour affichage unique
        unset($_SESSION['flashMessage']);
    }
}

function isUserConnected()
{
    return isset($_SESSION['utilisateur']);
}

function getUserFullName()
{
    if(isUserConnected()) {
        return $_SESSION['utilisateur']['prenom'] . ' ' . $_SESSION['utilisateur']['nom'];
    }
}

function isUserAdmin()
{
    return isUserConnected() && $_SESSION['utilisateur']['role'] == 'admin';
}

function adminSecurity()
{
    if (!isUserAdmin()) {
        if (!isUserConnected()) {
            header('Location: ' . RACINE_WEB . 'connexion.php');
        } else {
            header('HTTP/1.1 403 Forbidden');
            echo "Vous n'avez pas le droit d'accéder à cette page";
        }
   
        die;
    }
}

function prixFr($prix)
{
    return number_format($prix, 2, ',', ' ') . ' €';
}

function formatDate($date_commande)
{
    return strtotime('d/m/Y H:i:s');
}

function datetimeFr($datetimeSql)
{
    return date('d/m/Y H:i', strtotime($datetimeSql));
}

function ajoutPanier(array $produit, $quantite)
{
    // initialisation du panier
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }
    
    // si le produit n'est pas encore dans le panier
    if(!isset($_SESSION['panier'][$produit['id']])) {
        $_SESSION['panier'][$produit['id']] = [
            'nom' => $produit['nom'],
            'prix' => $produit['prix'],
            'quantite' => $quantite
        ];
    } else {
        // si le produit est déjà dans le panier, on met à jour la quantité
        $_SESSION['panier'][$produit['id']]['quantite'] += $quantite;
    }
}

function totalPanier()
{
   $panier = $_SESSION['panier'];
   $total = 0;
   
   if (isset($panier)){
       foreach ($panier as $produit) {
           $total += $produit['quantite'] * $produit['prix'];
        }       
   }
   return $total;
}

function modifierQuantitePanier($produitId, $quantite)
{
    // $panier = &$_SESSION['panier'];
   
    if (isset($_SESSION['panier'][$produitId])) {
        if ($quantite != 0) {
            $_SESSION['panier'][$produitId]['quantite'] = $quantite;
        } else {
            unset($_SESSION['panier'][$produitId]);
        }
    }
}