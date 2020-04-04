<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';

// Configuration de la page
$PAGE = [
    'title' => 'Ajouter un Cours',
    'template' => 'creerNouveauCours.phtml'
];

/*
    Si le formulaire de cette page a été "submitted",
    on exécute ce "if"
*/
if ($_POST) {
    $title          = $_POST['titre'];
    $beginDate      = $_POST['dateDebut'];
    $endDate        = $_POST['dateFin'];
    $idClass        = $_POST['idClasse'];
    $state          = $_POST['etat'];
    

    // ============================
    // Vérifications diverses liées à un ajout d'un cours
    $ERRORS = [];
    // ============================

    // 1. Est-ce que les champs sont vides ?
    if (empty($title)) {
        $ERRORS[] = 'Le champs "titre" doit être rempli';
    }
    if (empty($beginDate)) {
        $ERRORS[] = 'Le champs "date de début" doit être rempli';
    }
    if (empty($endDate)) {
        $ERRORS[] = 'Le champs "date de fin" doit être rempli';
    }
    if (empty($idClass)) {
        $ERRORS[] = 'Le champs "classe" doit être rempli';
    }
    if (empty($state)) {
        $ERRORS[] = 'Le champs "état" doit être rempli';
    }
    

    // Si à ce stade on a détecté des erreurs, on s'arrête là et on renvoie les erreurs au client
    if (!empty($ERRORS)) {
        include('integrations/MASTER.phtml');
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
            etat
            
        ) VALUES (
            :titre,
            :dateDebut,
            :dateFin,
            :idClasse,
            :etat
        )"
    ); 

    // Les appels à 'bindParam' rendent le code plus verbeux, mais permettent de contrôler le type de la donnée qui entre dans chaque champs de la table
    $query->bindParam(':titre', $title, PDO::PARAM_STR);
    $query->bindParam(':dateDebut', $beginDate, PDO::PARAM_STR);
    $query->bindParam(':dateFin', $endDate, PDO::PARAM_STR);
    $query->bindParam(':idClasse', $idClass, PDO::PARAM_INT);
    $query->bindParam(':etat', $state, PDO::PARAM_STR);
    

    $query->execute();

    echo "L'utilisateur a bien été créé !";

}


$query = $pdo->query(
    'SELECT idClasse, nom FROM classes'
);

$classes = $query->fetchAll();


// Affichage
include 'integrations/MASTER.phtml';