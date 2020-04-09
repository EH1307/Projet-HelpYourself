<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';


// Vérification de l'existence d'un ID dans l'URL

if (!array_key_exists('idUtilisateur', $_POST)) {
    header('Location:listeDesUtilisateurs.php');
    exit();
}


$name          = $_POST['nom'];
$firstname     = $_POST['prenom'];
$email         = $_POST['email'];
$password      = $_POST['motDePasse'];
$role          = $_POST['role'];
$idClasse      = $_POST['idClasse'];


// Insertion des infos de l'utilisateurs
$query = $pdo->prepare(
    'INSERT INTO utilisateurs
    VALUE  nom = :nom , prenom = :prenom , email = :email, motDePasse = :motDePasse , role = :role , idClasse = :idClasse'
    
);

$query->bindParam(':nom', $name, PDO::PARAM_STR);
$query->bindParam(':prenom', $firstname, PDO::PARAM_STR);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->bindParam(':motDePasse', $password, PDO::PARAM_STR);
$query->bindParam(':role', $role, PDO::PARAM_STR);
$query->bindParam(':idClasse', $idClasse, PDO::PARAM_INT);


$query->execute();

header('Location: listeDesUtilisateurs.php');
exit();