<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';

// Configuration de la page
$PAGE = [
    'title' => 'Ajouter un Utilisateur',
    'template' => 'ajoutUtilisateur.phtml'
];

/*
    Si le formulaire de cette page a été "submitted",
    on exécute ce "if"
*/
if ($_POST) {
    $name            = $_POST['name'];
    $firstname       = $_POST['firstname'];
    $email           = $_POST['email'];
    $enterpassword   = $_POST['enterpassword'];
    $role            = $_POST['role'];
    $idClasse        = $_POST['class'];


    // Insertion en base de données des informations
    $query = $pdo->prepare(
    "INSERT INTO
        utilisateurs (
            idUtilisateur,
            nom,
            prenom,
            email,
            motDePasse,
            role,
            idClasse
        ) VALUES (
            NULL,
            :nom,
            :prenom
            :email,
            :motDePasse,
            :role,
            :idClasse
        )"
    ); 

    // Les appels à 'bindParam' rendent le code plus verbeux, mais permettent de contrôler le type de la donnée qui entre dans chaque champs de la table
    $query->bindParam(':nom', $name, PDO::PARAM_STR);
    $query->bindParam(':prenom', $firstname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':motDePasse', $enterpassword, PDO::PARAM_STR);
    $query->bindParam(':role', $role, PDO::PARAM_STR);
    $query->bindParam(':idClasse', $idClasse, PDO::PARAM_INT);

    $query->execute();

    echo "L'utilisateur a bien été créé !";

}


$query = $pdo->query(
    'SELECT idClasse, nom FROM classes'
);

$classes = $query->fetchAll();

// Affichage
include 'integrations/MASTER.phtml';