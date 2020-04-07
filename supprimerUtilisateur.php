<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';

// Suppression de l'utilisateur dans la base de donnée

if (!array_key_exists('id', $_GET)) {
  header('Location: listeDesUtilisateurs.php');
  exit();
}

$id = $_GET['id'];



$query = $pdo->prepare(
  'DELETE FROM utilisateurs WHERE idUtilisateur = :id'
);
$query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();


header('Location: listeDesUtilisateurs.php');
exit();