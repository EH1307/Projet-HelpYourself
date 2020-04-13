<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

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

// Affichage
$PAGE = [
    'title' => 'Cours Formateur',
    'template' => '../Formateurs/coursFormateur.phtml'
];
$navigation = "formateurCours";
include '../integrations/MASTER.phtml';