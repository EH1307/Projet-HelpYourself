<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

if ($_POST) {
    $email        = $_POST['email'];
    $motDePasse   = hash('sha256',$_POST['motDePasse']);

    $query = $pdo->prepare(
        'SELECT * FROM utilisateurs WHERE email=:email AND motDePasse=:motDePasse'
    );
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':motDePasse', $motDePasse, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    if($query->rowCount() == 1){
        
        // utilisateur connecté
        session_start();
        $_SESSION['role'] = $user['role'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['idUtilisateur'] = $user['idUtilisateur'];
        $_SESSION['idClasse'] = $user['idClasse'];

        switch($user['role']){
            case "administrateur":
                header('Location: ../Administrateur/accueilAdministrateur.php');
                exit();
            case "formateur":
                header('Location: ../Formateurs/accueilFormateurs.php');
                exit();
            default:
                header('Location: ../Etudiants/accueilEtudiant.php');
                exit();
            break;
        }
    }else{
        header('Location: connexion.php?error=1');
        exit();
    }
    
}

if(isset($_GET['error'])){
    $ERRORS[] = "Identifiants invalides !";
}

// Affichage
$PAGE = [
    'title' => 'Connexion',
    'template' => '../Accueil/connexion.phtml'
];

$navigation = "connexion";

include '../integrations/MASTER.phtml';
