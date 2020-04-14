<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

onlyAccessableBy('formateur');

// Affichage
$PAGE = [
    'title' => 'Accueil Formateur',
    'template' => '../Formateurs/accueilFormateurs.phtml'
];

$navigation = "accueilFormateurs";

include '../integrations/MASTER.phtml';