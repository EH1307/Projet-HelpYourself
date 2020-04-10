<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

// Configuration de la page
$PAGE = [
    'title' => 'Créer un nouvel Utilisateur',
    'template' => '../Utilisateurs/formulaireAjoutUtilisateur.phtml'
];

$navigation = "utilisateur";

$query = $pdo->query(
    'SELECT idClasse, nom FROM classes'
);

$classes = $query->fetchAll();

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



    // ============================
    // Vérifications diverses liées à un ajout d'utilisateur
    $ERRORS = [];
    // ============================

    // 1. Est-ce que les champs sont vides ?
    if (empty($name)) {
        $ERRORS[] = 'Le champs "nom" doit être rempli';
    }
    if (empty($firstname)) {
        $ERRORS[] = 'Le champs "prenom" doit être rempli';
    }
    if (empty($email)) {
        $ERRORS[] = 'Le champs "email" doit être rempli';
    }
    if (empty($enterpassword)) {
        $ERRORS[] = 'Le champs "mot de passe" doit être rempli';
    }
    if (empty($role)) {
        $ERRORS[] = 'Le champs "rôle" doit être rempli';
    }
    if (empty($idClasse)) {
        $ERRORS[] = 'Le champs "classe" doit être rempli';
    }

    // Si à ce stade on a détecté des erreurs, on s'arrête là et on renvoie les erreurs au client
    if (!empty($ERRORS)) {
        include('../integrations/MASTER.phtml');
        return; // Stoppe l'exécution du script ici !
    }

    // 2. Est-ce que l'adresse email existe déjà en base ?
    $query = $pdo->prepare(
        'SELECT * FROM utilisateurs WHERE email=:email'
    );
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

      // 3. Est-ce que l'@ email est valide (cad qu'elle respecte la norme RFC standard) ?
    // https://www.php.net/manual/fr/function.filter-var.php
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $ERRORS[] = "L'adresse email utilisée est invalide !";
        include('integrations/MASTER.phtml');
        return; // Stoppe l'exécution du script ici !
    }

    // 5. Hachage du mot de passe avant l'insertion
    $hashPassword = hash('sha256', $enterpassword);


    // Insertion en base de données des informations
    $query = $pdo->prepare(
    "INSERT INTO
        utilisateurs (
            nom,
            prenom,
            email,
            motDePasse,
            role,
            idClasse
        ) VALUES (
            :nom,
            :prenom,
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
    $query->bindParam(':motDePasse', $hashPassword, PDO::PARAM_STR);
    $query->bindParam(':role', $role, PDO::PARAM_STR);
    $query->bindParam(':idClasse', $idClasse, PDO::PARAM_INT);

    $query->execute();

    header('Location: listeDesUtilisateurs.php');
    exit();

}

include '../integrations/MASTER.phtml';
