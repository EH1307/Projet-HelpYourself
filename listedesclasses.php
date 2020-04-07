<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';



/*
    Requête SQL permettant d'aller chercher toutes les classes
    dans la base de données
*/

$query = $pdo->query(
    'SELECT idClasse, nom FROM classes'
);
$query->execute();
$classes = $query->fetchAll();

// Affichage

$PAGE = [
    'title' => 'Liste des classes',
    'template' => 'listeDesClasses.phtml'
];

include 'integrations/MASTER.phtml';