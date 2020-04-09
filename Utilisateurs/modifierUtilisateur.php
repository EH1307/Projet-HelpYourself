<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';


// Vérification de l'existence d'un ID dans l'URL

if (!array_key_exists('idUtilisateur', $_POST)) {
    header('Location:listeDesUtilisateurs.php');
    exit();
}

$idUtilisateur = $_POST['idUtilisateur'];
$name          = $_POST['nom'];
$firstname     = $_POST['prenom'];
$email         = $_POST['email'];
$password      = $_POST['motDePasse'];
$role          = $_POST['role'];
$idClasse      = $_POST['idClasse'];


// Récupération des infos de l'utilisateurs
$query = $pdo->prepare(
    'UPDATE utilisateurs
    SET  nom = :nom , prenom = :prenom , email = :email, motDePasse = :motDePasse , role = :role , idClasse = :idClasse
    WHERE idUtilisateur = :idUtilisateur'
);
$query->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
$query->bindParam(':nom', $name, PDO::PARAM_STR);
$query->bindParam(':prenom', $firstname, PDO::PARAM_STR);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->bindParam(':motDePasse', $password, PDO::PARAM_STR);
$query->bindParam(':role', $role, PDO::PARAM_STR);
$query->bindParam(':idClasse', $idClasse, PDO::PARAM_INT);


$query->execute();

header('Location: listeDesUtilisateurs.php');
exit();