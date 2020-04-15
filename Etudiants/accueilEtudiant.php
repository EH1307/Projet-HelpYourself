<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

onlyAccessableBy('etudiant');

/*
    Requête SQL permettant d'aller chercher tous les cours
    dans la base de données
*/

$query = $pdo->prepare(
    'SELECT * FROM cours WHERE idClasse = :idClasse'
);
$query->bindParam(':idClasse', $_SESSION['idClasse'], PDO::PARAM_INT);
$query ->execute();
$cours = $query->fetchAll();

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
    'title' => 'Accueil Étudiant',
    'template' => '../Etudiants/accueilEtudiant.phtml'
];

include '../integrations/MASTER.phtml';