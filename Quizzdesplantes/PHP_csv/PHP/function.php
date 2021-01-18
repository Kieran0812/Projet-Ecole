<?php

	/*
		function de lecture du fichier csv
		en paramètre le nom du fichier à lire (chemin)
	*/
	function readCsv($filename,$delimiter) {
		$datas=array();
		//on ouvre le fichier en lecture
		if (($handle = fopen($filename, "r")) !== FALSE) {
			$compteur=0;
			//on lit le fichier ligne par ligne
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
								
				//on ajoute la ligne à un tableau php
				
				
				$datas[$compteur]=$data;
				$compteur=$compteur+1;
			}
			fclose($handle);
		}
		return $datas;
	}
		function cript() {
        $datas=readCsv('user.csv',",");
            for ($i=0;$i<count($value);$i++){
                if ($_POST['email']==$value[$i][2]){
                    $crypt=password_hash($value[0].$value[1].$value[2],PASSWORD_ARGON2I);
                }
            }
        return $crypt;
    }
?>
