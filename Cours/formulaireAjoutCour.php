<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

// Configuration de la page
$PAGE = [
    'title' => 'Ajouter un Cour',
    'template' => '../Cours/formulaireAjoutCour.phtml'
];

$navigation = "cour";


$query = $pdo->query(
    'SELECT * FROM classes'
);

$classes = $query->fetchAll();

$query = $pdo->query(
    "SELECT * FROM utilisateurs WHERE role = 'formateur'"
);

$utilisateurs = $query->fetchAll();

/*
    Si le formulaire de cette page a été "submitted",
    on exécute ce "if"
*/
if ($_POST) {
    $titre          = $_POST['titre'];
    $dateDebut      = date("Y-m-d H:i:s",strtotime($_POST['dateDebut']));
    $dateFin        = date("Y-m-d H:i:s",strtotime($_POST['dateFin']));
    $idClasse       = $_POST['idClasse'];
    $idUtilisateurs = $_POST['idUtilisateurs'];
    $etat           = $_POST['etat'];
    

    // ============================
    // Vérifications diverses liées à un ajout d'un cours
    $ERRORS = [];
    // ============================

    // 1. Est-ce que les champs sont vides ?
    if (empty($titre)) {
        $ERRORS[] = 'Le champs "titre" doit être rempli';
    }
    if (empty($dateDebut)) {
        $ERRORS[] = 'Le champs "date de début" doit être rempli';
    }
    if (empty($dateFin)) {
        $ERRORS[] = 'Le champs "date de fin" doit être rempli';
    }
    if (empty($idClasse)) {
        $ERRORS[] = 'Le champs "classe" doit être rempli';
    }
    if (empty($etat)) {
        $ERRORS[] = 'Le champs "état" doit être rempli';
    }
    
    // Si à ce stade on a détecté des erreurs, on s'arrête là et on renvoie les erreurs au client
    if (!empty($ERRORS)) {
        include('../integrations/MASTER.phtml');
        return; // Stoppe l'exécution du script ici !
    }

    // Insertion en base de données des informations
    $query = $pdo->prepare(
    "INSERT INTO
        cours (
            titre,
            dateDebut,
            dateFin,
            idClasse,
            idUtilisateurs,
            etat
            
        ) VALUES (
            :titre,
            :dateDebut,
            :dateFin,
            :idClasse,
            :idUtilisateurs,
            :etat
        )"
    ); 

    // Les appels à 'bindParam' rendent le code plus verbeux, mais permettent de contrôler le type de la donnée qui entre dans chaque champs de la table
    $query->bindParam(':titre', $titre, PDO::PARAM_STR);
    $query->bindParam(':dateDebut', $dateDebut, PDO::PARAM_STR);
    $query->bindParam(':dateFin', $dateFin, PDO::PARAM_STR);
    $query->bindParam(':idClasse', $idClasse, PDO::PARAM_INT);
    $query->bindParam(':idUtilisateurs', $idUtilisateurs, PDO::PARAM_INT);
    $query->bindParam(':etat', $etat, PDO::PARAM_STR);
    

    $query->execute();

    echo "Le cour a bien été créé !";

    header('Location: listeDesCours.php');
    exit();

}


// Affichage

include '../integrations/MASTER.phtml';