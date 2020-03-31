<?php
loadEnv('config/.env');

// Configuration des identifiants de la base de donnée
define('DATABASE_HOST', getenv('DATABASE_HOST'));
define('DATABASE_NAME', getenv('DATABASE_NAME'));
define('DATABASE_USER', getenv('DATABASE_USER'));
define('DATABASE_PASS', getenv('DATABASE_PASS'));

// Création de l'objet PDO
$pdo = new PDO('mysql:host='.DATABASE_HOST.';dbname='.DATABASE_NAME, DATABASE_USER, DATABASE_PASS);

/*
	Permet d'indiquer à PDO que l'on souhaite voir les erreurs renvoyées par MySQL (ce qui n'est pas le cas par défaut)

	En mode développement, c'est une bonne chose car on souhaite voir ces erreurs pour débugguer. Mais pendant la mise en ligne,
	on laisse généralement ces erreurs cachées aux yeux des utilisateurs.
*/
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*
	Indique à PDO le mode de récupération des données par défaut en FETCH_ASSOC (tableau associatif)

	Typiquement, cela permet d'écrire :
		$donnees = $query->fetchAll();
	au lieu de :
		$donnees = $query->fetchAll(PDO::FETCH_ASSOC);
	à chaque fois !
*/
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// Définit le mode d'échange des données en UTF8
$pdo->exec('SET NAMES UTF8');

/**
 * Fonction permettant de charger un fichier d'environnement
 * contenant des informations sensibles
*/

function loadEnv($filename) {
    $content = file_get_contents($filename);
    $lines = explode("\n", $content);
    foreach ($lines as $line) {
        putenv(trim($line));
    }
}
