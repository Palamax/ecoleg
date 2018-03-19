<?php
	class c_utilisateur {
		
		private $modele;
		
		public function __construct($p_modele){
			$this->modele = $p_modele;
		}
		
        public function connexion($compte, $password, $retenir) {
			if(!empty($compte) AND !empty($password)) {
				$verification = $this->modele->connexion($compte, $password);
				if(!empty($verification)){
					$_SESSION['id'] = $verification->id;
					$_SESSION['nom'] = $verification->nom;
					$_SESSION['prenom'] = $verification->prenom;
					$_SESSION['time'] = time();
					$_SESSION['token'] = uniqid(rand(), true); //On génére un jeton totalement unique (c'est capital :D)
					$_SESSION['token_time'] = time(); //On enregistre aussi le timestamp correspondant au moment de la création du token
					return 0;
				}else{
					return 2;
				}
				/*if(!empty($verification)) {
                    $code_activation = $verification->code_activation;
                    
					if($code_activation == 0) {
						$_SESSION['id'] = $verification->id;

						if($retenir == 1) {
							Setcookie("u", $verification->id, time() + TIMEOUT_CONNEXION);
							Setcookie("p", hash('sha256', $password),time()+2592000);
						}
					} else { return 3; }
				} else { return 2; }*/
			} else { return 1; }
		}
        
        public function deconnexion() {
            setcookie('u', '', time()+1);
            setcookie('p', '', time()+1);
            
            $_SESSION['id'] = 0;
        }
	}
?>