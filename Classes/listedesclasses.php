<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

onlyAccessableBy('administrateur');

/*
    Requête SQL permettant d'aller chercher toutes les classes
    dans la base de données
*/

$query = $pdo->query(
    'SELECT * FROM classes'
);
$query->execute();
$classes = $query->fetchAll();

// Affichage

$PAGE = [
    'title' => 'Liste des classes',
    'template' => '../Classes/listeDesClasses.phtml'
];

$navigation = "classe";

include '../integrations/MASTER.phtml';