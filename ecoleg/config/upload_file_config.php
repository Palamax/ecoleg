<?php
    /* PARAMETRES FICHIER UPLOADS */
    define('UPLOAD_MAX_SIZE', 100000);    // Taille max en octets du fichier

    define('ACCUEIL_SLIDER_DIR', ADRESSE_ABSOLUE_URL . 'uploads/accueil/slider/');    // Repertoire cible slider
    define('ACCUEIL_PHOTO_PROFIL_DIR', ADRESSE_ABSOLUE_URL . 'uploads/accueil/photo_profil/');    // Repertoire cible photo profil
    
    define('ARTICLES_VIGNETTE_DIR', ADRESSE_ABSOLUE_URL . 'uploads/articles/vignette/');    // Repertoire cible vignette
    
    define('BIOGRAPHIE_PHOTO_PROFIL_DIR', ADRESSE_ABSOLUE_URL . 'uploads/biographie/photo_profil/');    // Repertoire cible photo profil
    
    define('TRAINING_VIGNETTE_DIR', ADRESSE_ABSOLUE_URL . 'uploads/training/vignette/');    // Repertoire cible vignette

    $extensions_valides = array('jpg','gif','png','jpeg');    // Extensions autorisees
?>