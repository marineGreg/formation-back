<?php

require_once __DIR__ . '/../include/init.php';
adminSecurity();

$query = 'DELETE FROM utilisateur WHERE id = ' . (int)$_GET['id'];
$pdo->exec($query);

setFlashMessage('Le membre a été supprimé');
header('Location: membres.php');
die;