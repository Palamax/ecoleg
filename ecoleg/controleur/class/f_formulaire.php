<?php

class f_formulaire {

	public function verify_name($name){
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
		  return 8;
		}
		return 0;
	}

	public function verify_email($email){
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  return 9; 
		}
		return 0;
	}

	public function verify_url($website){
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
	  		return 10;
		}
		return 0;
	}
    /* NEVER TRUST USER INPUT MY FRIEND */
    public function testInputData($data) {
		$data = trim($data);// Supprime espace en début et fin de chaine
		$data = stripslashes($data); // Déspécialise les anti slash
		$data = htmlspecialchars($data); // Evite l'exécution de code
		return $data;
	}

	/* 
		FILE UPLOADER 
		md5(uniqid())
	*/
	public function uploadPicture($p_FILES, $target, $nomFichier){
		$message = -1;
		if(!is_dir($target)){
			return $message = 16;
		}
	  	if(!empty($p_FILES['fichier']['name'])){

		    //1. strrchr renvoie l'extension avec le point (« . »).
			//2. substr(chaine,1) ignore le premier caractère de chaine.
			//3. strtolower met l'extension en minuscules.
			$extension_upload = strtolower(substr(strrchr($p_FILES['icone']['name'], '.'),1));

			if (in_array($extension_upload, $extensions_valides)){ // Si extension ok

				if($p_FILES['fichier']['size'] <= UPLOAD_MAX_SIZE){ // On vérifier la taille
					// Parcours du tableau d'erreurs
          			if(isset($_FILES['fichier']['error']) && UPLOAD_ERR_OK === $_FILES['fichier']['error']){

						$nom = $target . $nomFichier . '.' . $extension_upload; // On forme le nom
						$resultat = move_uploaded_file($p_FILES['icone']['tmp_name'], $nom);
						if ($resultat){
							return $message = 17;
						}

					}else{
						return $message = 18;
					} 

				}else{
					return $message = 19;
				}

			}else{
				return $message = 20;
			}

		}else{
			return $message = 21;
		}		
	}
}
?>