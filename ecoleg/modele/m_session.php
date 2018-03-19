<?php
	class m_session{
		
		private $base_de_donnee;
		
		public function __construct($base_de_donnee){
			$this->base_de_donnee = $base_de_donnee;
		}
		
        /* Vérifie les cookies de session */
		public function vérification_cookie() {
				$vérification_cookie = $this->base_de_donnee->prepare('SELECT id FROM utilisateurs WHERE id = ? AND password = ?');
				$vérification_cookie->bindValue(1, $_COOKIE['u'], PDO::PARAM_INT);
				$vérification_cookie->bindValue(2, $_COOKIE['p'], PDO::PARAM_STR);
				$vérification_cookie->execute();
				$retour_vérif = $vérification_cookie->fetch(PDO::FETCH_OBJ);
				
				return $retour_vérif->id;
		}


		/* 
		##############################
		#      statistiques 
		##############################
		*/

		// Verifie si l'utilisateur connectés est présent ou non dans la table cpt_connectes
		public function is_utilisateurs_connectes_existe($ip){
			$is_utilisateurs_connectes_existe = $this->base_de_donnee->prepare('SELECT COUNT(ip) as nb FROM cpt_connectes where ip = ?');
        	$is_utilisateurs_connectes_existe->bindValue(1, $ip, PDO::PARAM_STR);
	        $is_utilisateurs_connectes_existe->execute();

			$retour = $is_utilisateurs_connectes_existe->fetch(PDO::FETCH_ASSOC);
			$is_utilisateurs_connectes_existe->closeCursor();

            return  $retour;  
		}
		// Retourne le nombre d'utilisateurs connectés
		public function get_nombre_utilisateurs_connectes(){
			$get_nb_utilisateurs = $this->base_de_donnee->prepare('SELECT COUNT(ip) as nb FROM cpt_connectes');
	        $get_nb_utilisateurs->execute();

			$retour = $get_nb_utilisateurs->fetch(PDO::FETCH_ASSOC);
			$get_nb_utilisateurs->closeCursor();

            return  $retour;  
		}
		// Met à jour le nombre d'utilisateurs connectés
		public function update_nombre_utilisateurs_connectes($ip){
            $update_nb_utilisateurs = $this->base_de_donnee->prepare('UPDATE cpt_connectes SET timestamp = ? WHERE ip = ?');
            $update_nb_utilisateurs->bindValue(1, time(), PDO::PARAM_STR);
            $update_nb_utilisateurs->bindValue(2, $ip, PDO::PARAM_STR);
            $update_nb_utilisateurs->execute();
		}
		// Ajout un utilisateur connecté
		public function add_utilisateur_connecte($ip){
	        $add_utilisateur_connecte = $this->base_de_donnee->prepare('INSERT INTO cpt_connectes (ip, timestamp) VALUES (?, ?) ');
            $add_utilisateur_connecte->bindValue(1, $ip, PDO::PARAM_STR);
            $add_utilisateur_connecte->bindValue(2, time(), PDO::PARAM_STR);
	        $add_utilisateur_connecte->execute();
		}
		// Supprime un utilisateur connecté
		public function delete_utilisateur_connecte($time){
	        $delete_utilisateur_connecte = $this->base_de_donnee->prepare('DELETE FROM cpt_connectes WHERE timestamp < ?');
            $delete_utilisateur_connecte->bindValue(1, $time, PDO::PARAM_STR);
	        $delete_utilisateur_connecte->execute();
		}
		/*
			Tiens à jour le nombre de visite
			Information :
			- INSERT s'il n'existe
			- UPDATE s'il existe 

			Le tout en une requête grâce :
			si le tuple existe déjà (clé primaire ip + date), grâce à la clause ON DUPLICATE KEY on incrément le champ page_vue de 1 pour le tuple en question (ip + date)
		*/
		public function compter_visite($ip, $date){
		    $compter_visite = $this->base_de_donnee->prepare('INSERT INTO cpt_visites (ip , date_visite , pages_vues) VALUES (?, ?, 1) ON DUPLICATE KEY UPDATE pages_vues = pages_vues + 1');
		    $compter_visite->bindValue(1, $ip, PDO::PARAM_STR);
		    $compter_visite->bindValue(2, $date, PDO::PARAM_STR);
		    $compter_visite->execute();
		}

		/*
			Compte le nombre de visites total et le nombre de pages vues
		*/
		public function get_nbr_visite(){
			$get_nbr_visite = $this->base_de_donnee->prepare('SELECT COUNT(ip) as nbVisite, SUM(pages_vues) as nbPageVues FROM cpt_visites');
	        $get_nbr_visite->execute();

			$retour = $get_nbr_visite->fetch(PDO::FETCH_ASSOC);
			$get_nbr_visite->closeCursor();

            return  $retour;  
		}
		/*
			retourne toutes les informations de la table visites
		*/
		public function liste_table_visite($numPage){
			// Calcul num page - 1 * nbr element par page 
            $calcul = ($numPage - 1) * NB_ELEMENT_PAGE_LISTE_STATISTIQUES;

			$liste_table_visite = $this->base_de_donnee->prepare('SELECT * FROM cpt_visites LIMIT ?,' . NB_ELEMENT_PAGE_LISTE_STATISTIQUES);
			$liste_table_visite->bindValue(1, $calcul, PDO::PARAM_INT);
	        $liste_table_visite->execute();

			$retour = $liste_table_visite->fetchAll(PDO::FETCH_OBJ);
			$liste_table_visite->closeCursor();
            
			return $retour;
		}
		/*
			retourne toutes les informations de la table visites ordonné par le param
		*/
		public function liste_table_visite_order_by($numPage, $order){
			// Calcul num page - 1 * nbr element par page 
            $calcul = ($numPage - 1) * NB_ELEMENT_PAGE_LISTE_STATISTIQUES;

			$liste_table_visite = $this->base_de_donnee->prepare('SELECT * FROM cpt_visites ORDER BY ? DESC LIMIT ?,' . NB_ELEMENT_PAGE_LISTE_STATISTIQUES);
			$liste_table_visite->bindValue(1, $order, PDO::PARAM_STR);
			$liste_table_visite->bindValue(2, $calcul, PDO::PARAM_INT);
	        $liste_table_visite->execute();

			$retour = $liste_table_visite->fetchAll(PDO::FETCH_OBJ);
			$liste_table_visite->closeCursor();
            
			return $retour;
		}
	}
?>