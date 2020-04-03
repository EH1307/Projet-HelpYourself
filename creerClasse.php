<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';

// Configuration de la page
$PAGE = [
    'title' => 'Créer une Classe',
    'template' => 'creerClasse.phtml'
];

/*
    Requête SQL permettant d'aller chercher tous les utilisateurs
    dans la base de données
*/

/*
    Si le formulaire de cette page a été "submitted",
    on exécute ce "if"
*/
if ($_POST) {
    $name  = $_POST['name'];
    
    // ============================
    // Vérifications diverses liées à une inscription
    $ERRORS = [];
    // ============================

    // 1. Est-ce que les champs sont vides ?
    if (empty($name)) {
        $ERRORS[] = 'Le champs "nom" doit être rempli';
    }
    
    // Si à ce stade on a détecté des erreurs, on s'arrête là et on renvoie les erreurs au client
    if (!empty($ERRORS)) {
        include('integrations/MASTER.phtml');
        return; // Stoppe l'exécution du script ici !
    }

    // Insertion en base de données des informations
    $query = $pdo->prepare(
        "INSERT INTO
            classes (
                nom
            ) 
            VALUES (
                :nom   
            )"
    );
    // Les appels à 'bindParam' rendent le code plus verbeux, mais permettent de contrôler le type de la donnée qui entre dans chaque champs de la table
    $query->bindParam(':nom', $name, PDO::PARAM_STR);
    
    $query->execute();

    echo "La classe a bien été créé !";

}


// Affichage
include 'integrations/MASTER.phtml';