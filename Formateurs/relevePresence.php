<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

onlyAccessableBy('formateur');

// Requête SQL permettant d'aller chercher tous les cours , classes et utilisateurs
//   dans la base de données

$query = $pdo->prepare(
    'SELECT * FROM cours'
);
$query->execute();
$cours = $query->fetchAll();


$query = $pdo->prepare(
    'SELECT * FROM classes'
);
$query->execute();
$classes = $query->fetchAll();


$query = $pdo->query(
'SELECT idUtilisateur, nom, prenom , idClasse FROM utilisateurs'
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
    'title' => 'Relevé Présence',
    'template' => '../Formateurs/relevePresence.phtml'
];
$navigation = "relevePresence";

include '../integrations/MASTER.phtml';