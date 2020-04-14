<?php

// Inclusion de la configuration de la base de données afin que ce fichier puisse faire les appels en base correctement
include '../config/database.php';

session_start();
session_destroy();

header('Location: '.HOST_URL.'index.php');
exit();

