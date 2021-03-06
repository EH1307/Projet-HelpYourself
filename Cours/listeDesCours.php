<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

onlyAccessableBy('administrateur');

/*
    Requête SQL permettant d'aller chercher tous les cours
    dans la base de données
*/

$query = $pdo->query(
    'SELECT * FROM cours'
);
$query ->execute();
$cours = $query->fetchAll();

$query = $pdo->query(
    'SELECT idClasse, nom FROM classes'
);
$classes = $query->fetchAll();

// utilisateurs

$query = $pdo->query(
    'SELECT * FROM utilisateurs'
);
$result = $query->fetchAll();

$utilisateurs = array();
for($i=0; $i<count($result); $i++){
    $utilisateurs[$result[$i]['idUtilisateur']] = $result[$i]['nom']. ' '.$result[$i]['prenom'];
}

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
    'title' => 'Liste des Cours',
    'template' => '../Cours/listeDesCours.phtml'
];

$navigation = "cour";

setlocale(LC_TIME, "fr_FR");

include '../integrations/MASTER.phtml';