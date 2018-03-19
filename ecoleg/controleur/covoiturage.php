<?php
    /**** SESSION ****/
    session_start();

    /**** CLASS CONTROLEUR ****/
    require_once('class/c_session.php');
    require_once('class/t_texte.php');

    /**** MODELE ****/
    require_once('modele/m_session.php');
    require_once('modele/m_groupe.php');
    require_once('modele/m_groupePassager.php');
    require_once('modele/m_covoiturage.php');
    
    /**** OBJETS ****/
    $t_texte = new t_texte();
    $m_session = new m_session($base_de_donnee);
    $m_groupePassager = new m_groupePassager($base_de_donnee);
    $m_groupe = new m_groupe($base_de_donnee);
    $m_covoiturage = new m_covoiturage($base_de_donnee);
    $c_session = new c_session($m_session, $t_texte);

    /**** VERIF SESSION ****/
    $c_session->session();
    $idGroupe = null;
    $isConsultation = false;
    //RECHERCHE les passagers du groupe
    if(!empty($url_param[0])) {
       if(preg_match('#^[0-9]{1,}$#', $url_param[0])) {
            $idGroupe = $url_param[0];
            $groupe = $m_groupe->getGroupe($idGroupe);
            $liste_groupePassager = $m_groupePassager->getPassagerByGroupe($idGroupe);
            $liste_covoiturage = $m_covoiturage->getCovoiturageByGroupe($idGroupe);

            $derniereDateCovoiturage = $m_groupe->getDerniereDateCovoiturage($idGroupe);
            $rest = substr($derniereDateCovoiturage->MAX, 0, 10);
            $date = date("Y-m-d");
            if ($rest == $date){
                $isConsultation = true;
            }

       } 
    }

    if(isset($_POST['adresseCovoiturage']) && isset($_POST['idGroupePassager'])){
        $idGroupePassager = $_POST['idGroupePassager'];
		$libelleErreur = "";
        if ($_POST['adresseCovoiturage'] == ''){
            $libelleErreur = "L'adresse de covoiturage est obligatoire";
        }      
        if ($_POST['idGroupePassager'] == ''){
            $libelleErreur = $libelleErreur .'<br>Le conducteur est obligatoire';
        }       
        if ($libelleErreur == ''){
            foreach($liste_groupePassager as $groupePassager){
                if ($groupePassager->ID == $idGroupePassager){
                    $distance1=getDistance($groupePassager->ADRESSE, $_POST['adresseCovoiturage']);
                    $distance2=getDistance($_POST['adresseCovoiturage'], $groupe->DESTINATION);
                    $m_groupePassager->ajouterKmsConducteur($groupePassager->ID, $distance1+$distance2, 0);
                }else{
                    $distanceNormale=getDistance($groupePassager->ADRESSE, $groupe->DESTINATION);
                    $distance=getDistance($groupePassager->ADRESSE, $_POST['adresseCovoiturage']);
                    $economie=$distanceNormale-$distance;
                    $m_groupePassager->ajouterKmsPassager($groupePassager->ID, $distance, $economie);
                }
            }
            $liste_groupePassager = $m_groupePassager->getPassagerByGroupe($idGroupe);
            $isConsultation = true;
            //header('Location: '.ADRESSE_ABSOLUE_URL.'accueil');
        }

    }

	
	function getDistance2($adresse1,$adresse2)
	{
		$adresse1 = str_replace(" ", "+", $adresse1);
        $adresse2 = str_replace(" ", "+", $adresse2);

		$adresse1 = urlencode($adresse1);
		$adresse2 = urlencode($adresse2);
        $proxy = 'ptx.proxy.corp.sopra';
		$url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$adresse1."&destinations=".$adresse2."&mode=driving&key=AIzaSyBdH4G4F14RZV4F1gty8MZYiVHy0b4reB8";
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 80);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		$response = curl_exec($ch);
		curl_close($ch);
		$response_a = json_decode($response, true);
		$distance = $response_a['rows'][0]['elements'][0]['distance']['text'];
		$distance=str_replace(" km", "", $distance);

        if ($distance)
        {
            return $distance*2;
        }
        else
        {
            return "0";
        }
	}
	
	function getDistance1($adresse1,$adresse2){
        $adresse1 = str_replace(" ", "+", $adresse1);
        $adresse2 = str_replace(" ", "+", $adresse2);

		$adresse1 = urlencode($adresse1);
		$adresse2 = urlencode($adresse2);
        //$data = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/xml?origins='.$adresse1.'&destinations='.$adresse2.'&key=AIzaSyBdH4G4F14RZV4F1gty8MZYiVHy0b4reB8');
		$data = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/xml?origins=castres&destinations=albi&key=AIzaSyBdH4G4F14RZV4F1gty8MZYiVHy0b4reB8");
		$data = json_decode($data);
		$distance = 0;
		foreach($data->rows[0]->elements as $road) {
			$distance += $road->distance->value;
		}
		$distance=str_replace(" km", "", $distance);

        if ($data->status == "OK")
        {
            return $distance*2;
        }
        else
        {
            return "0";
        }
    }
    function getDistance($adresse1,$adresse2){
        $adresse1 = str_replace(" ", "+", $adresse1);
        $adresse2 = str_replace(" ", "+", $adresse2);

        $adresse1 = urlencode($adresse1);
        $adresse2 = urlencode($adresse2);
        
        $context = stream_context_create([
        'http' => [
        'proxy' => 'ptx.proxy.corp.sopra:8080',
        'request_fulluri' => true
        ],
        'ssl' => [
        'verify_peer'=> false,
        'verify_peer_name'=> false
        ]
        ]);

        $data =  file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/xml?origins='.$adresse1.'&destinations='.$adresse2.'&key=AIzaSyBdH4G4F14RZV4F1gty8MZYiVHy0b4reB8', true, $context);
        $root = simplexml_load_string($data);
        $distance=$root->row->element->distance->text;

        $distance=str_replace(" km", "", $distance);

        if ($root->status == "OK")
        {
            return $distance*2;
        }
        
        return 0;
    }
?>
