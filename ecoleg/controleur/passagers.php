<?php
    /**** SESSION ****/
    session_start();

    /**** CLASS CONTROLEUR ****/
    require_once('class/c_session.php');
    require_once('class/t_texte.php');

    /**** MODELE ****/
    require_once('modele/m_session.php');
    require_once('modele/m_passager.php');
    
    /**** OBJETS ****/
    $t_texte = new t_texte();
    
    $m_session = new m_session($base_de_donnee);
    $m_passager = new m_passager($base_de_donnee);
    $c_session = new c_session($m_session, $t_texte);

    /**** VERIF SESSION ****/
    $c_session->session();

    $liste_passager = $m_passager->getAllPassager();

    $idPassager = null;
    if(!empty($url_param[0])) {
       if(preg_match('#^[0-9]{1,}$#', $url_param[0])) {
            $idPassager = $url_param[0];
            if($idPassager != null){
                $m_passager->deletePassager($idPassager);
                $liste_passager = $m_passager->getAllPassager();
            }
       } 
    }
?>
