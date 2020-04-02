<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';

/*
    Si le formulaire de cette page a été "submitted",
    on exécute ce "if"
*/
if ($_POST) {
    echo "Des données ont été envoyées via le formulaire. Les voici :";
    var_dump($_POST);

    $name            = $_POST['name'];
    $firstname       = $_POST['firstname'];
    $email           = $_POST['email'];
    $enterpassword   = $_POST['enterpassword'];
    $confirmpassword = $_POST['confirmpassword'];

    // Insertion en base de données des informations
    $query = $pdo->prepare(
        "INSERT INTO
            utilisateurs (
                nom,
                prenom,
                email,
                motDePasse
            ) VALUES (
                :nom,
                :prenom,
                :email,
                :motDePasse
            )"
    );
    // Les appels à 'bindParam' rendent le code plus verbeux, mais permettent de contrôler le type de la donnée qui entre dans chaque champs de la table
    $query->bindParam(':nom', $name, PDO::PARAM_STR);
    $query->bindParam(':prenom', $firstname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':motDePasse', $enterpassword, PDO::PARAM_STR);

    $query->execute();

    echo "L'utilisateur a bien été créé !";

}

// Affichage
$PAGE = [
    'title' => 'Inscription',
    'template' => 'inscription.phtml'
];

include 'integrations/MASTER.phtml';