<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

// Vérification de l'existence d'un ID dans l'URL

if (!array_key_exists('idClasse', $_POST)) {
    header('Location:listeDesClasses.php');
    exit();
}

$idClasse = $_POST['idClasse'];
$name     = $_POST['nom'];


// Récupération des infos de la classe

$query = $pdo->prepare(
    'UPDATE classes
    SET  nom = :nom 
    WHERE idClasse = :idClasse'
);
$query->bindParam(':idClasse', $idClasse, PDO::PARAM_INT);
$query->bindParam(':nom', $name, PDO::PARAM_STR);

$query->execute();

header('Location: listeDesClasses.php');
exit();
