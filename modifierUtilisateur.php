<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';


// Vérification de l'existence d'un ID dans l'URL

if (!array_key_exists('idUtilisateur', $_POST)) {
    header('Location:listeDesUtilisateurs.php');
    exit();
}

$idUtilisateur = $_POST['idUtilisateur'];
$role = $_POST['role'];


// Récupération des infos de l'utilisateurs
$query = $pdo->prepare(
    'UPDATE'
);
$query->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
$query->bindParam(':role', $role, PDO::PARAM_STR);

$query->execute();

//header('Location: listeDesUtilisateurs.php');
//exit();