<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';

print_r($_POST);
exit();

// Vérification de l'existence d'un ID dans l'URL

if (!array_key_exists('id', $_GET)) {
    header('Location:modifierUtilisateur.php');
    exit();
}

$id = $_GET['id'];

// Récupération des infos de l'utilisateurs
$query = $pdo->prepare(
    ''
);
$query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();

header('Location: listeDesUtilisateurs.php');
exit();