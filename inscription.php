<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include 'config/database.php';



// Affichage
$PAGE = [
    'title' => 'Inscription',
    'template' => 'inscription.phtml'
];

include 'integrations/MASTER.phtml';