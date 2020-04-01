<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';



// Affichage
$PAGE = [
    'title' => 'Accueil Formateur',
    'template' => 'accueilFormateurs.phtml'
];

include 'integrations/MASTER.phtml';