<?php
	class t_texte{
		
        /* Prend en paramètre un timestamp et retourne une date relative */
		public function quand($timestamp){
			date_default_timezone_set('Europe/Paris');
			$superdate = date('d F Y', $timestamp);
			
			$superdate = str_replace('January', 'janvier', $superdate);
			$superdate = str_replace('February', 'février', $superdate);
			$superdate = str_replace('March', 'mars', $superdate);
			$superdate = str_replace('April', 'avril', $superdate);
			$superdate = str_replace('May', 'mai', $superdate);
			$superdate = str_replace('June', 'juin', $superdate);
			$superdate = str_replace('July', 'juillet', $superdate);
			$superdate = str_replace('August', 'aout', $superdate);
			$superdate = str_replace('September', 'septembre', $superdate);
			$superdate = str_replace('October', 'octobre', $superdate);
			$superdate = str_replace('November', 'novembre', $superdate);
			$superdate = str_replace('December', 'décembre', $superdate);
			
			return $superdate;
		}
        
        public function random_generateur($nb_car){
            $caractères = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
            $generation = '';
            for($i = 0; $i < $nb_car; $i++){
                $generation .= $caractères[rand(0, count($caractères)-1)];
            }
            return $generation;
        }

        /*
			Permet de parser du code BBCode et le convertir en HTML
        */
        public function convertBBcodeToHtml($texte){

    			$tmp = stripslashes($texte); // on supprimer les antislash de la chaine
    			$texte = nl2br(htmlentities($tmp)); // rajoute <br /> après chaque retour à la ligne

	    		$entree = array(
			        	'#\[b\](.*)\[/b\]#Usi',
				        '#\[i\](.*)\[/i\]#Usi',
				        '#\[u\](.*)\[/u\]#Usi',
				        '#\[img\](.*)\[/img\]#Usi',
				        '#\[url\](.*)\[/url\]#Usi',
				        '#\[left\](.*)\[/left\]#Usi',
				        '#\[center\](.*)\[/center\]#Usi',
				        '#\[right\](.*)\[/right\]#Usi',
				        '#\[justify\](.*)\[/justify\]#Usi',
				        '#\[t1\](.*)\[/t1\]#Usi',
				        '#\[t2\](.*)\[/t2\]#Usi',
				        '#\[t3\](.*)\[/t3\]#Usi',
				        '#\[liste\][puce](.*)\[/puce\]\[/liste\]#Usi'
				    );
				$sortie = array(
				        '<b class="bbcode-p">$1</b>',
				        '<i class="bbcode-p">$1</i>',
				        '<u class="bbcode-p">$1</u>',
				        '<img src="$1" alt="Image" class="img-responsive" style="margin:auto;" height="500" width="500"/>',
			        	'<a class="bbcode-p" href="$1">$1</a>',
				        '<p class="bbcode-p" style="text-align:left;">$1</p>',
				        '<p class="bbcode-p" style="text-align:center;">$1</p>',
				        '<p class="bbcode-p" style="text-align:right;">$1</p>',
				        '<p class="bbcode-p" style="text-align:justify;">$1</p>',
				        '<h1 class="bbcode-h1">$1</h1>',
				        '<h2 class="bbcode-h2">$1</h2>',
				        '<h3 class="bbcode-h3">$1</h3>',
				        '<ul><li>$1</li></ul>'
				    );
				$count = count($entree)-1; // On calcule la taille
			    for($i=0;$i<=$count;$i++){
			        $texte = preg_replace($entree[$i],$sortie[$i],$texte);
			    }

			    return $texte;
    	}// fin de la fonction

        /*
			Permet de parser du code BBCode et le convertir en HTML
        */
        public function convertHtmlToBBcode($texte){
    			$tmp = stripslashes($texte); // on supprimer les antislash de la chaine
    			$texte = str_replace('<br />','',$tmp); // on supprime <br /> et rajoute ' '

				$entree = array(
					        '#<b class="bbcode-p">(.*)</b>#Usi',
					        '#<i class="bbcode-p">(.*)</i>#Usi',
					        '#<u class="bbcode-p">(.*)</u>#Usi',
					        '#<img src="(.*)" alt="Image" class="img-responsive" style="margin:auto;" height="500" width="500"/>#Usi',
				        	'#<a class="bbcode-p" href="(.*)">(.*)</a>#Usi',
					        '#<p class="bbcode-p" style="text-align:left;">(.*)</p>#Usi',
					        '#<p class="bbcode-p" style="text-align:center;">(.*)</p>#Usi',
					        '#<p class="bbcode-p" style="text-align:right;">(.*)</p>#Usi',
					        '#<p class="bbcode-p" style="text-align:justify;">(.*)</p>#Usi',
					        '#<h1 class="bbcode-h1">(.*)</h1>#Usi',
					        '#<h2 class="bbcode-h2">(.*)</h2>#Usi',
					        '#<h3 class="bbcode-h3">(.*)</h3>#Usi',
					        '#<ul><li>(.*)</li></ul>#Usi'
				        );
				$sortie = array(
				        	'[b]$1[/b]',
					        '[i]$1[/i]',
					        '[u]$1[/u]',
					        '[img]$1[/img]',
					        '[url]$1[/url]',
					        '[left]$1[/left]',
					        '[center]$1[/center]',
					        '[right]$1[/right]',
					        '[justify]$1[/justify]',
					        '[t1]$1[/t1]',
					        '[t2]$1[/t2]',
					        '[t3]$1[/t3]',
					        '[liste][puce]$1[/puce][/liste]'
				        );
		        $count = count($entree)-1; // on calcule la taille
		        for($i=0;$i<=$count;$i++){
		                $texte = preg_replace($entree[$i],$sortie[$i],$texte);
		        }
		        
		        return $texte;
        }// fin de la fonction
	
	}
?>