<?php

	//func read csv

    function readCsv($filename) {
		$datas=array();
		if (($handle = fopen($filename, "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
				$datas[]=$data;
			}
			fclose($handle);
		}
		return $datas;
	}

    //func question de type a : catégorie et 4 images

    function question_type_a() {

        //selectionne la bonne image

        // if(isset($_GET['lang']) && $_GET['lang']){}
        switch($_SESSION['lang']){ // selectionne le tableau selon la langue
            default:
            case 'fr':
                $tableau=readCsv("../CSV/tableauplantefrancais.csv"); 
                break;
            case 'en':
                $tableau=readCsv("../CSV/tableauplante.csv"); 
                break;
        } 
        
        $nombre=rand(1,(count($tableau)-1)); //nombre entre 0 et x , definit la ligne pour bonne image
        $categorie=rand(2,(count($tableau[0])-1)); //nombre entre 2 et x , definit la colonnes
        $nombre_image=rand(1,2); //nombre entre 1 et 4 , selectionne une image 
        $nom_image=$tableau[$nombre][1]; //va chercher dans le tableau le contenue de la case 1 = le nom latin

        $bonne_image=$nom_image.$nombre_image.".jpg"; //sort le nom d'une plante + un nombre / ex : Adansonia_digitata2.png

        //selectionne les 3 mauvaise image

        $liste_mauvaise_image=array(); // créer une liste de tout les mauvaise image/réponse
        for ($i=1;$i<(count($tableau));$i++) { 
            if ($tableau[$i][$categorie]!=$tableau[$nombre][$categorie]){
                $liste_mauvaise_image[]=$tableau[$i][1];
            }	
        }

        $mauvais1=rand(0,(count($liste_mauvaise_image)-1)); //nombre entre 0 et x , definit la ligne pour mauvaise image 1
        $mauvais2=$mauvais1; 
        $mauvais3=$mauvais1; 
        
        while ($mauvais2==$mauvais1) {
            $mauvais2=rand(0,(count($liste_mauvaise_image)-1)); //nombre entre 0 et x , definit la ligne pour mauvaise image 2
        }
        while ($mauvais3==$mauvais1||$mauvais3==$mauvais2) {
            $mauvais3=rand(0,(count($liste_mauvaise_image)-1)); //nombre entre 0 et x , definit la ligne pour mauvaise image 3
        }

        for ($i=1;$i<4;$i++) { 
            ${"nombre_image".($i+1)}=rand(1,2); 
            ${"mauvaise_image".$i}=($liste_mauvaise_image[${"mauvais".$i}]).${"nombre_image".($i+1)}.".jpg"; //sort le nom d'une plante + un nombre / ex : Adansonia_digitata2.png	
        }

        switch($_SESSION['lang']){ // selectionne la phrase de la question selon la langue/la categorie
            default:
            case 'fr':
                switch ($categorie){
                    case 2:
                        $question_text="A quel plante cette description fait référence ? ".$tableau[$nombre][$categorie]; 
                        break;
                    case 3:
                        $question_text="Quel vegetal est natif de ".$tableau[$nombre][$categorie]." ?"; 
                        break;
                    case 10:
                        $question_text="Quel vegetal est ".$tableau[$nombre][$categorie]." ?"; 
                        break;
                    case 4:
                    case 5:
                    case 6:
                    case 7:
                        $question_text="Quel vegetal est de ".$tableau[0][$categorie]." : ".$tableau[$nombre][$categorie]." ?"; 
                        break;
                    case 8:
                        $question_text="Quel vegetal se trouve principalement dans ".$tableau[$nombre][$categorie]." ?"; 
                        break;
                    case 9:
                        if ($tableau[$nombre][$categorie]!="pas de fleur") {
                            $question_text="Quel plante éclos en ".$tableau[$nombre][$categorie]." ?"; 
                        break;
                        }else{
                            $question_text="Quel plante n'a pas de fleur ?"; 
                        }  
                    
                }
                break;
            case 'en':
                switch ($categorie){
                    case 2:
                        $question_text="To which plant this description refer to ? ".$tableau[$nombre][$categorie]; 
                        break;
                    case 3:
                        $question_text="Which plant is native from ".$tableau[$nombre][$categorie]." ?"; 
                        break;
                    case 10:
                        $question_text="Which plant is a ".$tableau[$nombre][$categorie]." ?"; 
                        break;
                    case 4:
                    case 5:
                    case 6:
                    case 7:
                        $question_text="Which plant is of ".$tableau[0][$categorie]." : ".$tableau[$nombre][$categorie]." ?"; 
                        break;
                    case 8:
                        $question_text="Which plant do you find commonly in ".$tableau[$nombre][$categorie]." ?"; 
                        break;
                    case 9:
                        if ($tableau[$nombre][$categorie]!="no flower") {
                            $question_text="Which plant flowerin in a ".$tableau[$nombre][$categorie]." ?"; 
                        break;
                        }else{
                            $question_text="Which plant doesn't have flowers ?"; 
                        }
                }
                break;
        }

        return array("typea",$question_text,$bonne_image,$mauvaise_image1,$mauvaise_image2,$mauvaise_image3,$categorie);
    }

    //func question de type b : nom latin et 4 nom commun

    function question_type_b() {

        //selectionne la bonne image

        // if(isset ($_GET['lang']) && $_GET['lang']){} 
        switch($_SESSION['lang']){ // selectionne le tableau selon la langue
            default:
            case 'fr':
                $tableau=readCsv("../CSV/tableauplantefrancais.csv"); 
                break;
            case 'en':
                $tableau=readCsv("../CSV/tableauplante.csv"); 
                break;
        }
        
        $nombre=rand(1,(count($tableau)-1)); //nombre entre 0 et x , definit la ligne pour bonne image
        $Latin=$tableau[$nombre][1]; //va chercher dans le tableau le contenue de la case 1 = le nom latin
        $bon_nom=$tableau[$nombre][0]; //va chercher dans le tableau le contenue de la case 0 = le nom

        //selectionne les 3 mauvaise image

        $mauvais1=$nombre;
        $mauvais2=$nombre;
        $mauvais3=$nombre; 
        
        while ($mauvais1==$nombre) {
            $mauvais1=rand(1,(count($tableau)-1)); //nombre entre 0 et x , definit la ligne pour mauvaise image 1
        }
        while ($mauvais2==$nombre||$mauvais2==$mauvais1) {
            $mauvais2=rand(1,(count($tableau)-1)); //nombre entre 0 et x , definit la ligne pour mauvaise image 2
        }
        while ($mauvais3==$nombre||$mauvais3==$mauvais1||$mauvais3==$mauvais2) {
            $mauvais3=rand(1,(count($tableau)-1)); //nombre entre 0 et x , definit la ligne pour mauvaise image 3
        }

        for ($i=1;$i<4;$i++) { 
            ${"mauvais_nom".$i}=($tableau[${"mauvais".$i}][0]); //sort le nom d'une plante + un nombre / ex : Adansonia_digitata2.png	
        }
        

        switch($_SESSION['lang']){ // selectionne la phrase de la question selon la langue
            default:
            case 'fr':
                $question_text="Quel est le nom commun de ".$question_text=$Latin." ?"; 
                break;
            case 'en':
                $question_text="What is the common name of ".$question_text=$Latin." ?"; 
                break;
        }

        return array("typeb",$question_text,$bon_nom,$mauvais_nom1,$mauvais_nom2,$mauvais_nom3);
    }
?>