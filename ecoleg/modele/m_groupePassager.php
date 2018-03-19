<?php
	class m_groupePassager{
		
		private $base_de_donnee;
		
		public function __construct($base_de_donnee){
			$this->base_de_donnee = $base_de_donnee;
		}
	
        public function getPassagerByGroupe($idGroupe){
            $connexion = $this->base_de_donnee->prepare('SELECT gp.ID, p.NOM, p.PRENOM, p.ADRESSE, gp.KMS, gp.COMPTEUR, gp.ECONOMIE FROM groupepassager as gp INNER JOIN passager as p on gp.ID_PASSAGER = p.ID where ID_GROUPE = ? order by gp.COMPTEUR, gp.DATE_CONDUCTEUR');
            $connexion->bindValue(1, $idGroupe, PDO::PARAM_INT);
			$connexion->execute();
			$retour = $connexion->fetchAll(PDO::FETCH_OBJ);
			$connexion->closeCursor();
     
            return  $retour;  
        }

        public function getStatistique(){
            $connexion = $this->base_de_donnee->prepare('SELECT p.ID, p.NOM, p.PRENOM, SUM(gp.COMPTEUR) as CPT, SUM(gp.KMS) as KMS, SUM(gp.ECONOMIE) as ECO FROM groupepassager as gp INNER JOIN passager as p on gp.ID_PASSAGER = p.ID group by p.ID, p.NOM, p.PRENOM order by ECO desc');
            $connexion->execute();
            $retour = $connexion->fetchAll(PDO::FETCH_OBJ);
            $connexion->closeCursor();
     
            return  $retour;  
        }

        /*
            PERMET D'AJOUTER UN Groupe
        */    
        public function ajouterGroupePassager($idGroupe, $idPassager){
            $lastId = null;
            try {
                $ajouterGroupePassager = $this->base_de_donnee->prepare('INSERT groupePassager SET ID_GROUPE = ?, ID_PASSAGER = ?, COMPTEUR=0, KMS=0, ECONOMIE=0');
                $ajouterGroupePassager->bindValue(1, $idGroupe, PDO::PARAM_INT);
                $ajouterGroupePassager->bindValue(2, $idPassager, PDO::PARAM_INT);
                $ajouterGroupePassager->execute();
            } catch (Exception $e) {
                if(strstr($e->getMessage(), 'SQLSTATE[23000]')) { 
                    throw new Exception('Ce passager appartient déjà à ce groupe.');
                }else{
                    throw new Exception('Erreur technique !!');
                }
            } finally {
                $lastId = $this->base_de_donnee->lastInsertId();
            }
            return $lastId;
        }


        /*
            PERMET DE SUPPRESSION D'UN GroupePassager
        */    
        public function deleteGroupePassager($id){
            $deletePassager = $this->base_de_donnee->prepare('DELETE FROM groupePassager where ID = ?');
            $deletePassager->bindValue(1, $id, PDO::PARAM_INT);
            $deletePassager->execute();
        }

        /*
            PERMET D'AJOUTER les kms
        */    
        public function ajouterKmsConducteur($idGroupePassager, $kms){
            $ajouterKms = $this->base_de_donnee->prepare('UPDATE groupePassager SET COMPTEUR = COMPTEUR + 1, DATE_CONDUCTEUR = CURRENT_TIMESTAMP, KMS = KMS + ? where ID = ?');
            $ajouterKms->bindValue(1, $kms, PDO::PARAM_INT);
            $ajouterKms->bindValue(2, $idGroupePassager, PDO::PARAM_INT);

            $ajouterKms->execute();
        }
        public function ajouterKmsPassager($idGroupePassager, $kms, $economie){
            $ajouterKms = $this->base_de_donnee->prepare('UPDATE groupePassager SET KMS = KMS + ?, ECONOMIE = ECONOMIE + ? where ID = ?');
            $ajouterKms->bindValue(1, $kms, PDO::PARAM_INT);
            $ajouterKms->bindValue(2, $economie, PDO::PARAM_INT);
            $ajouterKms->bindValue(3, $idGroupePassager, PDO::PARAM_INT);

            $ajouterKms->execute();
        }        
	}
?>