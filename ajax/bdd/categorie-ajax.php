<?php
require_once __DIR__ . '/cnx.php';

if (!empty($_POST['nom'])) {
    $query = 'INSERT INTO categorie (nom) VALUES (:nom)';
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':nom', $_POST['nom']);
    $stmt->execute();
    
    $response = [
        'statut' => 'ok',
        'message' => 'La catégorie est créée'
    ];
} else {
    $response = [
        'statut' => 'ko',
        'message' => 'Le nom ne doit pas être vide'
    ];
}

echo json_encode($response);
