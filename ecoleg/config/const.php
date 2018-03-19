<?php
	/* CHEMINS */
	define('DS', '/'); //DIRECTORY_SEPARATOR
	define('ROOT', dirname(dirname(__FILE__)));

	/* BASE DE DONNEE */
	define('CONST_DB_HOST', "localhost");
	define('CONST_DB_NAME', "covoiturage");
	define('CONST_DB_USER', "root");
	define('CONST_DB_PASS', "");
	
	/* PARAMETRES */
	define('AFFICHER_ERREURS', true);
	define('PAGE_DEFAUT', 'login');
	define('TIMEOUT_CONNEXION', 2592000);
	define('TIMEOUT_MOBILE_SESSION', 3600);
	define('NB_ELEMENT_PAGE', 5);
	define('NB_ELEMENT_PAGE_LISTE_STATISTIQUES', 15);
	define('NB_TENTATIVE_SOUMISSION', 5);
	define('TEMPS_AVANT_NOUVELLE_TENTATIVE_SOUMISSION', 5);
	define('TAILLE_MINIMAL_PASSWORD', 10);

    /* CHAINES */
    define('NOM_PAGE_DEFAUT', '');
    define('DESCRIPTION_DEFAUT', '');
    define('KEYWORDS_DEFAUTS', '');

    /* PATH  */
    define('BOOTSRAP_CSS', './css/bootstrap.css');
    define('STYLE_CSS', './vue/css/style.css');
    define('IMAGES_STYLE', './vue/images/');
    //define('ADRESSE_ABSOLUE_URL', 'http://192.168.0.100/ecoleg/');
	//define('ADRESSE_ABSOLUE_URL', 'http://172.30.252.30/ecoleg/');
	define('ADRESSE_ABSOLUE_URL', 'http://172.30.250.28/ecoleg/');
	


    /* INCLUSION DE FICHIERS CONF */
    require_once('pages_existantes.php');
    require_once('upload_file_config.php');
    require_once('code_retour.php');

?>