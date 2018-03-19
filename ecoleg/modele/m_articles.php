<?php
	class m_articles{

		private $base_de_donnee;
		
		public function __construct($base_de_donnee){
			$this->base_de_donnee = $base_de_donnee;
		}
        
        /*
            PERMET DE LISTE L'ENSEMBLE DES ARTICLEs
        */
		public function liste_articles($numPage) {

                // Calcul num page - 1 * nbr element par page 
                $calcul = ($numPage - 1) * NB_ELEMENT_PAGE;
         
				$liste_articles = $this->base_de_donnee->prepare('SELECT * FROM articles LIMIT ?, '.NB_ELEMENT_PAGE);
                $liste_articles->bindValue(1, $calcul, PDO::PARAM_INT);
				$liste_articles->execute();
            
				$retour = $liste_articles->fetchAll(PDO::FETCH_OBJ);
				$liste_articles->closeCursor();
            
				return $retour;
		}

		/*
            PERMET DE RECHERCHER DES ARTICLEs
        */
		public function rechercher_articles($recherche){
            
            //permet de stocker le résultat dans un tableau, on supprime les espaces
            $s = explode(" ", $recherche);
            // On stocke notre requête dans une variable qu'on pourra modifier en fonction des résultats
            $sqlAND = "SELECT * FROM articles";
            $sqlOR = "SELECT * FROM articles";
            $i=0; // indice

            // On va parcourir le tableau $s
            foreach($s as $mots){
                // pour éviter injection sql
                $mots = addslashes($mots); 

                if(strlen($mots)>3){ // pour éviter les petits mots comme le de etc... 
                    if($i==0){
                        $sqlAND.= " WHERE ";
                        $sqlOR.= " WHERE ";
                    }
                    else{
                        $sqlAND.= " AND ";
                        $sqlOR.= " OR ";
                    }
                    // On met en place enfin la requête sql
                    $sqlAND.="detailBien like '%$mots%'";
                    $sqlOR.="detailBien like '%$mots%'";
                    // On incrémente l'indice
                    $i++;
                }

                // UNION des 2 requêtes AND et OR
                $sql = $sqlAND ." UNION ".$sqlOR;

                // Traitement requête
                $rechercher_articles = $bdd->prepare($sql);
                $rechercher_articles->execute();
                $retour = $rechercher_articles->fetch(PDO::FETCH_OBJ);
                    
				return $retour;
		}
	}
    /*
        PERMET D'OBTENIR UN ARTICLE
    */    
    public function get_articles($id){
        $afficher_articles = $this->base_de_donnee->prepare('SELECT * FROM articles WHERE id=?');
        $afficher_articles->bindValue(1, $id, PDO::PARAM_INT);
        $afficher_articles->execute();
        
        $retour = $afficher_articles->fetch(PDO::FETCH_OBJ);
        $afficher_articles->closeCursor();
            
        return $retour;
    }

    /*
        PERMET D'AJOUTER UN ARTICLE
    */    
    public function add_articles($titre, $texte, $description, $url, $date, $auteur){
        $ajouter_articles = $this->base_de_donnee->prepare('INSERT INTO articles (titre, texte, description, url, datePublication, auteur) 
        values (?, ?, ?, ?, ?, ?) ');
        $ajouter_articles->bindValue(1, $titre, PDO::PARAM_STR);
        $ajouter_articles->bindValue(2, $texte, PDO::PARAM_STR);
        $ajouter_articles->bindValue(3, $description, PDO::PARAM_STR);
        $ajouter_articles->bindValue(4, $url, PDO::PARAM_STR);
        $ajouter_articles->bindValue(5, $date, PDO::PARAM_INT);
        $ajouter_articles->bindValue(6, $auteur, PDO::PARAM_STR);
        $ajouter_articles->execute();
    }
    /*
        PERMET D'AJOUTER UN ARTICLE
    */    
    public function update_articles($id, $titre, $texte, $description, $url, $date, $auteur){
        $update_articles = $this->base_de_donnee->prepare('UPDATE articles SET  titre = ?, texte = ?, description = ?, url = ? , datePublication = ? , auteur = ? WHERE id = ?');
        $update_articles->bindValue(1, $titre, PDO::PARAM_STR);
        $update_articles->bindValue(2, $texte, PDO::PARAM_STR);
        $update_articles->bindValue(3, $description, PDO::PARAM_STR);
        $update_articles->bindValue(4, $url, PDO::PARAM_STR);
        $update_articles->bindValue(5, $date, PDO::PARAM_INT);
        $update_articles->bindValue(6, $auteur, PDO::PARAM_STR);
        $update_articles->bindValue(7, $id, PDO::PARAM_STR);
        $update_articles->execute();
    }

    /*
        PERMET DE SUPPRIMER UN ARTICLE
    */    
    public function delete_articles($id){
        $delete_articles = $this->base_de_donnee->prepare('DELETE FROM articles WHERE id = ?');
        $delete_articles->bindValue(1, $id, PDO::PARAM_INT);
        $delete_articles->execute();
    }
}
?>