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
    $c_session = new c_session($m_session, $t_texte);
    $m_passager = new m_passager($base_de_donnee);

    /**** VERIF SESSION ****/
    $c_session->session();
    

    if(isset($_POST['inputEmail']) && isset($_POST['inputPassword'])){
        if ($_POST['inputEmail'] == ''){
            $libelleErreur = 'Le login est obligatoire.';
        }
        if ($_POST['inputPassword'] == ''){
            $libelleErreur = 'Le mot de passe est obligatoire.';
        }

        $passager = $m_passager->getPassagerByEmail($_POST['inputEmail']);

        if ($passager == null || $passager->ID == null){
            $libelleErreur = 'Utilisateur introuvable !!';
        }else{
            $_SESSION['user'] = $passager;
            header('Location: '.ADRESSE_ABSOLUE_URL.'accueil');
        }  
    }
?>
