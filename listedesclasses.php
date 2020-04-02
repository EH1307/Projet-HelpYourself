<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';

/*
    Requête SQL permettant d'aller chercher tous les utilisateurs
    dans la base de données
*/

$query = $pdo->query(
    'SELECT idClasse, nom FROM classes'
);

$classes = $query->fetchAll();

// Affichage
$PAGE = [
    'title' => 'Liste des classes',
    'template' => 'listedesclasses.phtml'
];

include 'integrations/MASTER.phtml';