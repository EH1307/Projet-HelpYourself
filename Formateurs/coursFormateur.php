<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

onlyAccessableBy('formateur');

/*
    Requête SQL permettant d'aller chercher tous les cours
    dans la base de données
*/

$query = $pdo->prepare(
    'SELECT * FROM cours WHERE idUtilisateurs = :idUtilisateur'
);
$query->bindParam(':idUtilisateur', $_SESSION['idUtilisateur'], PDO::PARAM_INT);
$query ->execute();
$cours = $query->fetchAll();

$query = $pdo->query( 
    'SELECT idClasse, nom FROM classes'
);
$classes = $query->fetchAll();

// classes
$query = $pdo->query(
    'SELECT idClasse, nom FROM classes'
);
$result = $query->fetchAll();

$classes = array();
for($j=0; $j<count($result); $j++){
    $classes[$result[$j]['idClasse']] = $result[$j]['nom'];
}


// Affichage
$PAGE = [
    'title' => 'Cours Formateur',
    'template' => '../Formateurs/coursFormateur.phtml'
];
$navigation = "formateurCours";
include '../integrations/MASTER.phtml';