<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

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
'SELECT idUtilisateur, nom, prenom FROM utilisateurs'
);
$query->execute();
$utilisateurs = $query->fetchAll();


// Affichage
$PAGE = [
    'title' => 'Relevé Présence',
    'template' => '../Formateurs/relevePresence.phtml'
];
$navigation = "relevePresence";

include '../integrations/MASTER.phtml';