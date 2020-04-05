<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';

// Vérification de l'existence d'un ID dans l'URL
/*
if (!array_key_exists('id', $_GET)) {
    header('Location:listeDesUtilisateurs.php');
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
*/
/*
    Requête SQL permettant d'aller chercher tous les utilisateurs
    dans la base de données
*/

$query = $pdo->query(
    'SELECT idUtilisateur, nom, prenom FROM utilisateurs'
);

$utilisateurs = $query->fetchAll();

// Affichage
$PAGE = [
    'title' => 'Les Utilisateurs',
    'template' => 'listeDesUtilisateurs.phtml'
];

include 'integrations/MASTER.phtml';