<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

if ($_POST) {
    $email        = $_POST['email'];
    $motDePasse   = hash('sha256',$_POST['motDePasse']);

    $query = $pdo->prepare(
        'SELECT * FROM utilisateurs WHERE email=:email AND motDePasse=:motDePasse'
    );
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':motDePasse', $motDePasse, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    print_r($user);
    exit();
}


// Affichage
$PAGE = [
    'title' => 'Connexion',
    'template' => '../Accueil/connexion.phtml'
];

$navigation = "connexion";

include '../integrations/MASTER.phtml';
