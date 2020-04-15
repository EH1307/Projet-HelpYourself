<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

onlyAccessableBy('administrateur');

// Suppression du cours dans la base de donnée

if (!array_key_exists('id', $_GET)) {
    header('Location: listeDesCours.php');
    exit();
  }
  
  $id = $_GET['id'];
  
  
  
  $query = $pdo->prepare(
    'DELETE FROM cours WHERE idCours = :id'
  );
  $query->bindParam(':id', $id, PDO::PARAM_INT);
  $query->execute();
  
  
  header('Location: listeDesCours.php');
  exit();
