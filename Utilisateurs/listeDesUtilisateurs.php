<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

onlyAccessableBy('administrateur');

// Récupération des infos de l'utilisateurs
$query = $pdo->prepare(
    'SELECT * FROM classes'
);
$query->execute();
$classes = $query->fetchAll();

$query = $pdo->prepare(
    'SELECT * FROM utilisateurs'
);
$query->execute();
$utilisateurs = $query->fetchAll();

// classes
$query = $pdo->query(
    'SELECT idClasse, nom FROM classes'
);
$result = $query->fetchAll();

$classes = array();
for($j=0; $j<count($result); $j++){
    $classes[$result[$j]['idClasse']] = $result[$j]['nom'];
}



// Affichage
$PAGE = [
    'title' => 'Les Utilisateurs',
    'template' => '../Utilisateurs/listeDesUtilisateurs.phtml'
];

$navigation = "utilisateur";

include '../integrations/MASTER.phtml';