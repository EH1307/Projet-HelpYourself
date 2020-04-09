<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';

// Vérification de l'existence d'un ID dans l'URL

if (!array_key_exists('id', $_GET)) {
    header('Location:modifierClasse.php');
    exit();
}

$id = $_GET['id'];

// Récupération des infos de la classe
$query = $pdo->prepare(
    'SELECT * FROM classes WHERE idClasse = :id'
);
$query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();
$classe = $query->fetch();

// Affichage
$PAGE = [
    'title' => 'Modifier une Classe',
    'template' => 'formulaireClasse.phtml'
];


include 'integrations/MASTER.phtml';