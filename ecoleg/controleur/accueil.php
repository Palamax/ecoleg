<?php
    /**** SESSION ****/
    session_start();

    /**** CLASS CONTROLEUR ****/
    require_once('class/c_session.php');
    require_once('class/t_texte.php');

    /**** MODELE ****/
    require_once('modele/m_session.php');
    require_once('modele/m_groupePassager.php');
    
    /**** OBJETS ****/
    $t_texte = new t_texte();
    
    $m_session = new m_session($base_de_donnee);
    $c_session = new c_session($m_session, $t_texte);
    $m_groupePassager = new m_groupePassager($base_de_donnee);

    /**** VERIF SESSION ****/
    $c_session->session();

    $statistique = $m_groupePassager->getStatistique();
?>
