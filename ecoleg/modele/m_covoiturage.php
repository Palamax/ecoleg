<?php
	class m_covoiturage{
		
		private $base_de_donnee;
		
		public function __construct($base_de_donnee){
			$this->base_de_donnee = $base_de_donnee;
		}


        public function getCovoiturageByGroupe($idGroupe){
            $connexion = $this->base_de_donnee->prepare('SELECT ID, ADRESSE FROM covoiturage where ID_GROUPE = ?' );
            $connexion->bindValue(1, $idGroupe, PDO::PARAM_INT);
            $connexion->execute();
            $retour = $connexion->fetchAll(PDO::FETCH_OBJ);
            $connexion->closeCursor();
     
            return  $retour;  
        }
        /*
            PERMET D'AJOUTER UN POINT DE COVOITURAGE
        */    
        public function ajouterCovoiturage($idGroupe, $adresse){
            $ajouterCovoiturage = $this->base_de_donnee->prepare('INSERT covoiturage SET ID_GROUPE = ?, ADRESSE = ?');
            $ajouterCovoiturage->bindValue(1, $idGroupe, PDO::PARAM_INT);
            $ajouterCovoiturage->bindValue(2, $adresse, PDO::PARAM_STR);
            $ajouterCovoiturage->execute();
            $lastId = $this->base_de_donnee->lastInsertId();
            return $lastId;
        }

        /*
            PERMET DE SUPPRESSION D'UN POINT DE COVOITURAGE
        */    
        public function deleteCovoiturage($id){
            $deleteCovoiturage = $this->base_de_donnee->prepare('DELETE FROM covoiturage where ID = ?');
            $deleteCovoiturage->bindValue(1, $id, PDO::PARAM_INT);
            $deleteCovoiturage->execute();
        }
	}
?>