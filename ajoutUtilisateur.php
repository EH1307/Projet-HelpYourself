<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';

// Configuration de la page
$PAGE = [
    'title' => 'Ajouter un Utilisateur',
    'template' => 'ajoutUtilisateur.phtml'
];

$query = $pdo->query(
    'SELECT idUtilisateur, nom, prenom FROM utilisateurs'
);

$utilisateurs = $query->fetchAll();

/*
    Si le formulaire de cette page a été "submitted",
    on exécute ce "if"
*/
if ($_POST) {
    $name            = $_POST['name'];
    $firstname       = $_POST['firstname'];

// Insertion en base de données des informations
$query = $pdo->prepare(
    "INSERT INTO
        utilisateurs (
            nom,
            prenom
        ) VALUES (
            :nom,
            :prenom
        )"
); 

 // Les appels à 'bindParam' rendent le code plus verbeux, mais permettent de contrôler le type de la donnée qui entre dans chaque champs de la table
 $query->bindParam(':nom', $name, PDO::PARAM_STR);
 $query->bindParam(':prenom', $firstname, PDO::PARAM_STR);


 $query->execute();

 echo "L'utilisateur a bien été créé !";

}



/*
    Requête SQL permettant d'aller chercher tous les utilisateurs
    dans la base de données
*/


// Affichage
include 'integrations/MASTER.phtml';