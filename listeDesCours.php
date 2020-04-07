<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';

/*
    Requête SQL permettant d'aller chercher tous les cours
    dans la base de données
*/

$query = $pdo->query(
    'SELECT titre,etat FROM cours'
);

$listeDesCours = $query->fetchAll();

// Affichage
$PAGE = [
    'title' => 'Liste des Cours',
    'template' => 'listeDesCours.phtml'
];

$navigation = "cour";

include 'integrations/MASTER.phtml';