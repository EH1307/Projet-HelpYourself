<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';

// Récupération des infos de l'utilisateurs
$query = $pdo->prepare(
    'SELECT * FROM classes'
);
$query->execute();
$classes = $query->fetchAll();


// Affichage
$PAGE = [
    'title' => 'Modifier une Classe',
    'template' => 'modifierClasse.phtml'
];

include 'integrations/MASTER.phtml';