<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

/*
    Requête SQL qui va compter le nombre d'éléments
    dans la table "utilisateurs" dans la base de données
*/
$query = $pdo->query(
    'SELECT COUNT(*) AS nbUtilisateurs FROM utilisateurs'
);
$result = $query->fetch();

$nbUtilisateurs = $result['nbUtilisateurs'];

// Affichage
$PAGE = [
    'title' => 'Accueil',
    'template' => '../Accueil/index.phtml'
];


include '../integrations/MASTER.phtml';
