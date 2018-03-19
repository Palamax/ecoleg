<?php
	class m_admin{
		
		private $base_de_donnee;
		
		public function __construct($base_de_donnee){
			$this->base_de_donnee = $base_de_donnee;
		}
	
        public function connexion($compte, $password){
            $connexion = $this->base_de_donnee->prepare('SELECT * FROM loic WHERE login = ? AND password = ?');
            $connexion->bindValue(1, $compte, PDO::PARAM_STR);
			$connexion->bindValue(2, hash('sha256', $password), PDO::PARAM_STR);
			$connexion->execute();
            
			$retour = $connexion->fetch(PDO::FETCH_OBJ);
			$connexion->closeCursor();
     
            return  $retour;  
        }
        
        public function verification_compte_existant($compte){
            
            $verification_compte_existant = $this->base_de_donnee->prepare('SELECT login FROM loic where login = ?');
            $verification_compte_existant->bindValue(1, $compte, PDO::PARAM_STR);
            $verification_compte_existant->execute();
            
            $retour = $verification_compte_existant->fetch(PDO::FETCH_OBJ);
            $verification_compte_existant->closeCursor();
                
            return $retour;
        }
        
    /*    public function creation_compte_admin($nom, $prenom, $mail, $compte, $password){
          
            // Code d'activation initialisé à 0 pour le moment
            $code_activation = 0;
            $inscription = $this->base_de_donnee->prepare('INSERT INTO admin (nom, prenom, mail, compte, password, code_activation) 
            values (?, ?, ?, ?, ?, ?) ');
            $inscription->bindValue(1, $nom, PDO::PARAM_STR);
            $inscription->bindValue(2, $prenom, PDO::PARAM_STR);
            $inscription->bindValue(3, $mail, PDO::PARAM_STR);
            $inscription->bindValue(4, $compte, PDO::PARAM_STR);
            $inscription->bindValue(5, hash('sha256', $password), PDO::PARAM_STR);
            $inscription->bindValue(6, $code_activation, PDO::PARAM_STR);
            $inscription->execute();
            
        } */
       
        public function mise_a_jour_compte_admin($id, $login, $password, $email){
            
            $mise_a_jour_compte = $this->base_de_donnee->prepare('UPDATE loic SET  login = ?, email = ?, password = ? WHERE id = ?');
            
            $mise_a_jour_compte->bindValue(1, $login, PDO::PARAM_STR);
			$mise_a_jour_compte->bindValue(2, $email, PDO::PARAM_STR);
			$mise_a_jour_compte->bindValue(3, hash('sha256', $password), PDO::PARAM_STR);
            $mise_a_jour_compte->bindValue(4, $id, PDO::PARAM_INT);
            $mise_a_jour_compte->execute();
        }
        
        public function obtenir_information_admin($id){
            $obtenir_information_utilisateurs = $this->base_de_donnee->prepare('SELECT * FROM loic WHERE id = ?');
            $obtenir_information_utilisateurs->bindValue(1, $id, PDO::PARAM_INT);
            $obtenir_information_utilisateurs->execute();
            
            $retour = $obtenir_information_utilisateurs->fetch(PDO::FETCH_OBJ);
            $obtenir_information_utilisateurs->closeCursor();
                
            return $retour;
        }

        /* 
        ############################################
        #               BIOGRAPHIE                 #
        ############################################
        */
        public function mise_a_jour_biographie($id, $nom, $prenom, $description, $exercicesPreferes, $poids, $taille, $mensurations, $age, $photo){
            
            $mise_a_jour_compte = $this->base_de_donnee->prepare('UPDATE loic SET  nom = ?, prenom = ?, age = ?, poids = ?, taille = ?, exercice_prefere = ?, description = ?, photo = ?, mensuration = ? WHERE id = ?');

            $mise_a_jour_compte->bindValue(1, $nom, PDO::PARAM_STR);
            $mise_a_jour_compte->bindValue(2, $prenom, PDO::PARAM_STR);
            $mise_a_jour_compte->bindValue(3, $age, PDO::PARAM_INT);
            $mise_a_jour_compte->bindValue(4, $poids, PDO::PARAM_INT);
            $mise_a_jour_compte->bindValue(5, $taille, PDO::PARAM_INT);
            $mise_a_jour_compte->bindValue(6, $exercicesPreferes, PDO::PARAM_STR);
            $mise_a_jour_compte->bindValue(7, $description, PDO::PARAM_STR);
            $mise_a_jour_compte->bindValue(8, $photo, PDO::PARAM_STR);
            $mise_a_jour_compte->bindValue(9, $mensurations, PDO::PARAM_STR);
            $mise_a_jour_compte->bindValue(10, $id, PDO::PARAM_INT);
            $mise_a_jour_compte->execute();
        }

	}
?>