<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';

$nom = "CLERY";
$prenom = "JM";

// Affichage
$PAGE = [
    'title' => 'Accueil',
    'template' => 'index.phtml'
];


include 'integrations/MASTER.phtml';
