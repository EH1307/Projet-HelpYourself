<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

onlyAccessableBy('administrateur');


// Vérification de l'existence d'un ID dans l'URL

if (!array_key_exists('idCours', $_POST)) {
    header('Location:listeDesCours.php');
    exit();
}
// Debug 
// print_r($_POST);
// exit();


$titre          = $_POST['titre'];
$dateDebut      = date("Y-m-d H:i:s",strtotime($_POST['dateDebut']));
$dateFin        = date("Y-m-d H:i:s",strtotime($_POST['dateFin']));
$idClasse       = $_POST['idClasse'];
$etat           = $_POST['etat'];



// Récupération des infos des cours
$query = $pdo->prepare(
    'INSERT INTO cours
    VALUE   titre = :titre , dateDebut = :dateDebut, dateFin = :dateFin , idClasse = :idClasse , etat = :etat'
    
);

$query->bindParam(':titre', $titre, PDO::PARAM_STR);
$query->bindParam(':dateDebut', $dateDebut, PDO::PARAM_STR);
$query->bindParam(':dateFin', $dateFin, PDO::PARAM_STR);
$query->bindParam(':idClasse', $idClasse, PDO::PARAM_INT);
$query->bindParam(':etat', $etat, PDO::PARAM_STR);



$query->execute();

header('Location: listeDesCours.php');
exit();