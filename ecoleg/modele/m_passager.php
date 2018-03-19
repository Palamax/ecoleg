<?php
	class m_passager{
		
		private $base_de_donnee;
		
		public function __construct($base_de_donnee){
			$this->base_de_donnee = $base_de_donnee;
		}
	
        public function getAllPassager(){
            $connexion = $this->base_de_donnee->prepare('SELECT * FROM passager');
			$connexion->execute();
            
			$retour = $connexion->fetchAll(PDO::FETCH_OBJ);
			$connexion->closeCursor();
     
            return  $retour;  
        }

        
        public function getPassager($id){
            
            $requete = $this->base_de_donnee->prepare('SELECT * FROM passager where ID = ?');
            $requete->bindValue(1, $id, PDO::PARAM_INT);
            $requete->execute();
            
            $retour = $requete->fetch(PDO::FETCH_OBJ);
            $requete->closeCursor();
                
            return $retour;
        }

        public function getPassagerByEmail($email){
            
            $requete = $this->base_de_donnee->prepare('SELECT * FROM passager where EMAIL = ?');
            $requete->bindValue(1, $email, PDO::PARAM_STR);
            $requete->execute();
            
            $retour = $requete->fetch(PDO::FETCH_OBJ);
            $requete->closeCursor();

            return $retour;
         }       
           

        /*
            PERMET D'AJOUTER UN PASSAGER
        */    
        public function modifierPassager($nom, $prenom, $adresse, $telephone, $email, $id){
            $modifierPassager = $this->base_de_donnee->prepare('UPDATE passager SET NOM = ?, PRENOM = ?, ADRESSE = ?, TELEPHONE = ?, EMAIL = ? where ID = ?');
            $modifierPassager->bindValue(1, $nom, PDO::PARAM_STR);
            $modifierPassager->bindValue(2, $prenom, PDO::PARAM_STR);
            $modifierPassager->bindValue(3, $adresse, PDO::PARAM_STR);
            $modifierPassager->bindValue(4, $telephone, PDO::PARAM_STR);
            $modifierPassager->bindValue(5, $email, PDO::PARAM_STR);
            $modifierPassager->bindValue(6, $id, PDO::PARAM_INT);
            $modifierPassager->execute();
        }

        /*
            PERMET DE CREER UN PASSAGER
        */    
        public function creerPassager($nom, $prenom, $adresse, $telephone, $email){
            $creerPassager = $this->base_de_donnee->prepare('INSERT INTO passager (NOM, PRENOM, ADRESSE, TELEPHONE, EMAIL) values (?, ?, ?, ?, ?) ');
            $creerPassager->bindValue(1, $nom, PDO::PARAM_STR);
            $creerPassager->bindValue(2, $prenom, PDO::PARAM_STR);
            $creerPassager->bindValue(3, $adresse, PDO::PARAM_STR);
            $creerPassager->bindValue(4, $telephone, PDO::PARAM_STR);
            $creerPassager->bindValue(5, $email, PDO::PARAM_STR);            
            $creerPassager->execute();
            $lastId = $this->base_de_donnee->lastInsertId();
            return $lastId;
        }

                /*
            PERMET DE SUPPRESSION D'UN PASSAGER
        */    
        public function deletePassager($id){
            $deletePassager = $this->base_de_donnee->prepare('DELETE FROM passager where ID = ?');
            $deletePassager->bindValue(1, $id, PDO::PARAM_INT);
            $deletePassager->execute();
        }
	}
?>