<?php
    /**** SESSION ****/
    session_start();

    /**** CLASS CONTROLEUR ****/
    require_once('class/c_session.php');
    require_once('class/t_texte.php');
    require_once('class/f_formulaire.php');

    /**** MODELE ****/
    require_once('modele/m_session.php');
    require_once('modele/m_groupe.php');
    require_once('modele/m_groupePassager.php');
    require_once('modele/m_passager.php');
    require_once('modele/m_covoiturage.php');
    
    /**** OBJETS ****/
    $t_texte = new t_texte();
    $f_formulaire = new f_formulaire();
    
    $m_session = new m_session($base_de_donnee);
    $m_groupe = new m_groupe($base_de_donnee);
    $m_groupePassager = new m_groupePassager($base_de_donnee);
    $m_passager = new m_passager($base_de_donnee);
    $m_covoiturage = new m_covoiturage($base_de_donnee);
    $c_session = new c_session($m_session, $t_texte);

    /**** VERIF SESSION ****/
    $c_session->session();
    //$idGroupe = null;

    $liste_passager = $m_passager->getAllPassager();


    //RECHERCHE GROUPE
    if(!empty($url_param[0])) {
       if(preg_match('#^[0-9]{1,}$#', $url_param[0])) {
            $idGroupe = $url_param[0];
            $groupe = $m_groupe->getGroupe($idGroupe);

            $liste_groupePassager = $m_groupePassager->getPassagerByGroupe($idGroupe);
            $liste_covoiturage = $m_covoiturage->getCovoiturageByGroupe($idGroupe);
       } 
    }

    //ACTION
    if(!empty($url_param[1]) && !empty($url_param[2])) {
       if(preg_match('#^[0-9]{1,}$#', $url_param[2])) {
            $action = $url_param[1];
            $idSupprime = $url_param[2];
            echo  $action . '/' .  $idSupprime;
            if ($action == 'deletePassager'){
                $m_groupePassager->deleteGroupePassager($idSupprime);
                $liste_groupePassager = $m_groupePassager->getPassagerByGroupe($idGroupe);
                header('Location: '.ADRESSE_ABSOLUE_URL.'groupe/'.$idGroupe);
            } else  if ($action == 'deleteCovoiturage'){
                $m_covoiturage->deleteCovoiturage($idSupprime);
                $liste_covoiturage = $m_covoiturage->getCovoiturageByGroupe($idGroupe);
                header('Location: '.ADRESSE_ABSOLUE_URL.'groupe/'.$idGroupe);
            }
       } 
    }

    //Si ENREGISTREMENT
    if(isset($_POST['libelle']) && isset($_POST['destination'])){
        $libelle = $f_formulaire->testInputData($_POST['libelle']);
        $destination = $f_formulaire->testInputData($_POST['destination']);
        if ($_POST['libelle'] == ''){
            $libelleErreur = 'Le libellé est obligatoire.';
        }
        if ($_POST['destination'] == ''){
            $libelleErreur = 'La destination est obligatoire.';
        }
        if ($libelleErreur == ''){
            if(!isset($idGroupe)){
                $idGroupe = $m_groupe->creerGroupe($libelle, $destination);
                 header('Location: '.ADRESSE_ABSOLUE_URL.'groupe/'.$idGroupe);
            }else{
                $miseAjour = $m_groupe->modifierGroupe($libelle, $destination, $idGroupe);
            }
            
            $groupe = $m_groupe->getGroupe($idGroupe);
        }
    }

    //SI AJOUT PASSAGER
    if(isset($_POST['idPassagerAjouter']) && $_POST['idPassagerAjouter'] != ''){
        $idPassagerAjouter = $_POST['idPassagerAjouter'];
        try {
            $idGroupePassager = $m_groupePassager->ajouterGroupePassager($idGroupe, $idPassagerAjouter);
        } catch (Exception $e) {
            $libelleErreur = $e->getMessage();
        }

        $liste_groupePassager = $m_groupePassager->getPassagerByGroupe($idGroupe);
    }

    //SI AJOUT POINT DE COVOITURAGE
    if(isset($_POST['adresseCovoiturage']) && $_POST['adresseCovoiturage'] != ''){
        $adresseCovoiturage = $_POST['adresseCovoiturage'];
        try {
            $idCovoiturage = $m_covoiturage->ajouterCovoiturage($idGroupe, $adresseCovoiturage);
        } catch (Exception $e) {
            $libelleErreur = $e->getMessage();
        }

        $liste_covoiturage = $m_covoiturage->getCovoiturageByGroupe($idGroupe);
    }

    //RECHERCHE GROUPE
    if(isset($idGroupe) && $idGroupe != null) {
        $groupe = $m_groupe->getGroupe($idGroupe);
        $liste_groupePassager = $m_groupePassager->getPassagerByGroupe($idGroupe);
        $liste_covoiturage = $m_covoiturage->getCovoiturageByGroupe($idGroupe);
    }else{
        $idGroupe = null;
    }
?>
