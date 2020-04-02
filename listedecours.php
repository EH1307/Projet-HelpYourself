<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';

/*
    Requête SQL permettant d'aller chercher tous les cours
    dans la base de données
*/

$query = $pdo->query(
    'SELECT  titre  FROM cours'
);

$listedecours = $query->fetchAll();

// Affichage
$PAGE = [
    'title' => 'Liste des Cours',
    'template' => 'listedecours.phtml'
];

include 'integrations/MASTER.phtml';