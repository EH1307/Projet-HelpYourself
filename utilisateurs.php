<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';

/*
    Requête SQL permettant d'aller chercher tous les utilisateurs
    dans la base de données
*/

$query = $pdo->query(
    'SELECT idUtilisateur, nom, prenom FROM utilisateurs'
);

$utilisateurs = $query->fetchAll();

// Affichage
$PAGE = [
    'title' => 'Les Utilisateurs',
    'template' => 'utilisateurs.phtml'
];

include 'integrations/MASTER.phtml';