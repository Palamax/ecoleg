<?php
	class m_groupe{
		
		private $base_de_donnee;
		
		public function __construct($base_de_donnee){
			$this->base_de_donnee = $base_de_donnee;
		}
	
        public function getAllGroupe(){
            $connexion = $this->base_de_donnee->prepare('SELECT * FROM groupe');
			$connexion->execute();
            
			$retour = $connexion->fetchAll(PDO::FETCH_OBJ);
			$connexion->closeCursor();
     
            return  $retour;  
        }

        
        public function getGroupe($id){
            
            $requete = $this->base_de_donnee->prepare('SELECT * FROM groupe where ID = ?');
            $requete->bindValue(1, $id, PDO::PARAM_INT);
            $requete->execute();
            
            $retour = $requete->fetch(PDO::FETCH_OBJ);
            $requete->closeCursor();
                
            return $retour;
        }

        /*
            PERMET D'AJOUTER UN Groupe
        */    
        public function modifierGroupe($libelle, $destination, $id){
            $modifierGroupe = $this->base_de_donnee->prepare('UPDATE groupe SET LIBELLE = ?, DESTINATION = ? where ID = ?');
            $modifierGroupe->bindValue(1, $libelle, PDO::PARAM_STR);
            $modifierGroupe->bindValue(2, $destination, PDO::PARAM_STR);
            $modifierGroupe->bindValue(3, $id, PDO::PARAM_INT);
            $modifierGroupe->execute();
        }

        /*
            PERMET DE CREER UN Groupe
        */    
        public function creerGroupe($libelle, $destination){
            $creerGroupe = $this->base_de_donnee->prepare('INSERT INTO groupe (LIBELLE, DESTINATION) values (?, ?) ');
            $creerGroupe->bindValue(1, $libelle, PDO::PARAM_STR);
            $creerGroupe->bindValue(2, $destination, PDO::PARAM_STR);
            $creerGroupe->execute();
            $lastId = $this->base_de_donnee->lastInsertId();
            return $lastId;
        }

                /*
            PERMET DE SUPPRESSION D'UN Groupe
        */    
        public function deleteGroupe($id){
            $deleteGroupe = $this->base_de_donnee->prepare('DELETE FROM groupe where ID = ?');
            $deleteGroupe->bindValue(1, $id, PDO::PARAM_INT);
            $deleteGroupe->execute();
        }

        public function getDerniereDateCovoiturage($idGroupe){
            $connexion = $this->base_de_donnee->prepare('SELECT MAX(gp.DATE_CONDUCTEUR) as MAX FROM groupe as g INNER JOIN groupePassager as gp on gp.ID_GROUPE = g.ID where g.ID = ?');
            $connexion->bindValue(1, $idGroupe, PDO::PARAM_INT);
            $connexion->execute();
            $retour = $connexion->fetch(PDO::FETCH_OBJ);
            $connexion->closeCursor();
            return $retour;
        }
    }

?>