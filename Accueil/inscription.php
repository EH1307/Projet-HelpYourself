<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

// Configuration de la page
$PAGE = [
    'title' => 'Inscription',
    'template' => 'inscription.phtml'
];

// Exemples de hachage d'un mot de passe avec l'algorithme "SHA256"
// --------------
/*
    $testPass = "azerty";
    // echo "Valeur normale : $testPass<br>";
    echo "Valeur hachée : ". hash('sha256', $testPass) ."<br><br>";

    $testPass2 = "azerty";
    // echo "Valeur normale : $testPass2<br>";
    echo "Valeur hachée : ". hash('sha256', $testPass2) ."<br><br>";
*/
// --------------

/*
    Si le formulaire de cette page a été "submitted",
    on exécute ce "if"
*/
if ($_POST) {
    $name            = $_POST['name'];
    $firstname       = $_POST['firstname'];
    $email           = $_POST['email'];
    $motDePasse      = $_POST['motDePasse'];
    $confirmpassword = $_POST['confirmpassword'];

    // ============================
    // Vérifications diverses liées à une inscription
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
    if (empty($motDePasse)) {
        $ERRORS[] = 'Le champs "mot de passe" doit être rempli';
    }

    // Si à ce stade on a détecté des erreurs, on s'arrête là et on renvoie les erreurs au client
    if (!empty($ERRORS)) {
        include('integrations/MASTER.phtml');
        return; // Stoppe l'exécution du script ici !
    }

    // 2. Est-ce que l'adresse email existe déjà en base ?
    $query = $pdo->prepare(
        'SELECT * FROM utilisateurs WHERE email=:email'
    );
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    // Si la variable $user n'est pas vide, c'est on a bien récupéré un utilisateur ayant cette @ email
    if (!empty($user)) {
        $ERRORS[] = "Un utilisateur ayant cette adresse existe déjà !";
        include('integrations/MASTER.phtml');
        return; // Stoppe l'exécution du script ici !
    }

    // 3. Est-ce que l'@ email est valide (cad qu'elle respecte la norme RFC standard) ?
    // https://www.php.net/manual/fr/function.filter-var.php
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $ERRORS[] = "L'adresse email utilisée est invalide !";
        include('integrations/MASTER.phtml');
        return; // Stoppe l'exécution du script ici !
    }

    // 4. Vérification si les mots de passe correspondent
    if ($motDePasse !== $confirmpassword) {
        $ERRORS[] = "Les mots de passes ne correspondent pas !";
        include('integrations/MASTER.phtml');
        return; // Stoppe l'exécution du script ici !
    }

    // 5. Hachage du mot de passe avant l'insertion
    $hashPassword = hash('sha256', $motDePasse);

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
    $query->bindParam(':motDePasse', $hashPassword, PDO::PARAM_STR);

    $query->execute();

    echo "L'utilisateur a bien été créé !";

}

// Affichage

$navigation = "inscription";

include '../integrations/MASTER.phtml';