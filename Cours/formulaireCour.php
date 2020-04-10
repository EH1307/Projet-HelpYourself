<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

// Vérification de l'existence d'un ID dans l'URL

if (!array_key_exists('id', $_GET)) {
    header('Location:modifierCour.php');
    exit();
}

$id = $_GET['id'];

// Récupération des infos des cours
$query = $pdo->prepare(
    'SELECT * FROM cours WHERE idCours = :id'
);
$query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();
$cour = $query->fetch();

// Et Récupération de la liste des classes
$query = $pdo->query(
    'SELECT idClasse, nom FROM classes'
);
$classes = $query->fetchAll();

// Affichage
$PAGE = [
    'title' => 'Modifier un cour',
    'template' => 'formulaireCour.phtml'
];


$navigation = "cour";
include '../integrations/MASTER.phtml';