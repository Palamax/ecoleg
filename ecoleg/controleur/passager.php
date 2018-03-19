<?php
    /**** SESSION ****/
    session_start();

    /**** CLASS CONTROLEUR ****/
    require_once('class/c_session.php');
    require_once('class/t_texte.php');
    require_once('class/f_formulaire.php');
	
	//require('phpmailer/class.phpmailer.php');
	
	require('phpmailer/PHPMailerAutoload.php');

    /**** MODELE ****/
    require_once('modele/m_session.php');
    require_once('modele/m_passager.php');
    
    /**** OBJETS ****/
    $t_texte = new t_texte();
    $f_formulaire = new f_formulaire();
    
    $m_session = new m_session($base_de_donnee);
    $m_passager = new m_passager($base_de_donnee);
    $c_session = new c_session($m_session, $t_texte);

    /**** VERIF SESSION ****/
    $c_session->session();
    $idPassager = null;

    if(!empty($url_param[0])) {
       if(preg_match('#^[0-9]{1,}$#', $url_param[0])) {
            $idPassager = $url_param[0];
            $passager = $m_passager->getPassager($idPassager);
       } 
    }
    //redirection -> Accueil
/*    if($idPassager == null){
        header('Location: '.ADRESSE_ABSOLUE_URL.'accueil');
        exit;
    }*/

    //ENREGISTRER le passager
    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['adresse'])){
        if ($_POST['nom'] == ''){
            $libelleErreur = 'Le nom est obligatoire.';
        }
        if ($_POST['prenom'] == ''){
            $libelleErreur = 'Le prénom est obligatoire.';
        }
        if ($_POST['adresse'] == ''){
            $libelleErreur = 'L adresse est obligatoire.';
        }        
        if ($libelleErreur == ''){
            $nom = $f_formulaire->testInputData($_POST['nom']);
            $prenom = $f_formulaire->testInputData($_POST['prenom']);
            $adresse = $f_formulaire->testInputData($_POST['adresse']);
            $telephone = $f_formulaire->testInputData($_POST['telephone']);
            $email = $f_formulaire->testInputData($_POST['email']);
            if($idPassager == null){
                $idPassager = $m_passager->creerPassager($nom, $prenom, $adresse, $telephone, $email);
				/*$mail = new PHPmailer();
				//ici ce qui t'interesse
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->Host = "smtp.free.fr";	
				//$mail->SMTPSecure = "ssl";
				//$mail->Port = 465;
				$mail->Username = 'ecoleg.covoiturage';
				$mail->Password = 'K@li81100';
				//$mail->Host = "ptx.send.corp.sopra";
				$mail->Port = 587;
				//$mail->Username = 'svalery';
				//$mail->Password = 'Sopr@0517';	
				
				$mail->SMTPDebug = 2;
				//fin
				$mail->From='ecoleg.covoiturage@free.fr';
				//$mail->From='stephane.valery@soprasteria.com';
				$mail->AddAddress($email);
				$mail->AddReplyTo('ecoleg.covoiturage@free.fr');	
				//$mail->AddReplyTo('stephane.valery@soprasteria.com');	
				$mail->Subject='test envoi mail';
				$mail->Body='Voici un exemple d\'e-mail au format Texte';
				if(!$mail->Send()){ //Teste le return code de la fonction
				  echo $mail->ErrorInfo; 
				}
				else{			
				  echo 'Mail envoyé avec succès';
				}
				$mail->SmtpClose();
				unset($mail);	*/			
				
				
                header('Location: '.ADRESSE_ABSOLUE_URL.'passager/'.$idPassager);								
            }else{
                $id = $idPassager;
                $miseAjour = $m_passager->modifierPassager($nom, $prenom, $adresse, $telephone, $email, $id);
            }
            
            $passager = $m_passager->getPassager($idPassager);
        }

    }
?>
