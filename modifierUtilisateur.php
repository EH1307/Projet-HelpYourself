<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';

// Vérification de l'existence d'un ID dans l'URL

if (!array_key_exists('id', $_GET)) {
    header('Location:modifierUtilisateur.php');
    exit();
}

$id = $_GET['id'];

// Récupération des infos de l'utilisateurs
$query = $pdo->prepare(
    'SELECT * FROM utilisateurs WHERE idUtilisateur = :id'
);
$query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();
$utilisateur = $query->fetch();

// Et Récupération de la liste des classes
$query = $pdo->query(
    'SELECT idClasse, nom FROM classes'
);
$classes = $query->fetchAll();

// Affichage
$PAGE = [
    'title' => 'Modifier un Utilisateur',
    'template' => 'modifierUtilisateur.phtml'
];

include 'integrations/MASTER.phtml';