<?php
if($_GET){
        if(isset ($_GET['lang']) && $_GET['lang']){
            switch($_GET['lang']){
            //Si $_POST=fr on inclut le fichier de langue française
            default:
            case 'fr':
                include('francais.php');
            break;
            //Si $_POST=en on inclut le fichier de langue anglaise
            case 'en':
                include('english.php');
            break;
            case 'ger':
            //Si $_POST=ger on inclut le fichier de langue allemande
                include('ger.php');// non inclus on a pas de biere pour payée les traducteurs
            break;
            case 'it':
                //Si $_POST=it on inclut le fichier de langue italienne
                    include('it.php');// non inclus on a pas de pizzas pour payée les traducteurs
            break;
            case 'es':
                //Si $_POST=es on inclut le fichier de langue espagnol
                    include('es.php');// non inclus on a pas de corida pour payée les traducteurs
            break;
            case 'por':
                //Si $_POST=por on inclut le fichier de langue portugaise
                    include('por.php');// non inclus on a pas de maison a construire pour payée les traducteurs
            break;
        
            }
    }else {
        include ("francais.php");
    }
}else {
    include ("francais.php");
}
//verification
if (isset($_POST)&&$_POST) {
    if (isset($_POST["nom"])&&$_POST["nom"]) {
    }
    if (isset($_POST["prenom"])&&$_POST["prenom"]) {
    }
    if (isset($_POST["email"])&&$_POST["email"]) {
    }
    if (isset($_POST["mdp"])&&$_POST["mdp"]) {
    }
    if (isset($_POST["mdp2"])&&$_POST["mdp2"]) {
    }
}    
//control mot de passe et du pseudo
require('function.php');
$errormail="";
$errorpassord="";
$errorlanguepassword="";
$existe=false;
if(isset($_POST['submit'])){
    if ($_POST['password']==$_POST['repeatpassword']){
        $lire=readCSV("../CSV/user.csv",",");
        for ($i=0;$i<count($lire);$i++){
            //control du mail
            if ($_POST['email']==$lire[$i][2]){
                $errormail=$errorlanguemail;                   
                $existe=true;
                    }
        }              
            //creation du compte   
        if ($existe==false) {
            $list=array(array($_POST['nom'],$_POST['prenom'],$_POST['email'],password_hash($_POST['password'],PASSWORD_ARGON2I)));
                $_SESSION['nomprenom']=$_POST['nom']." ".$_POST['prenom'];
                $file=fopen('../CSV/user.csv','a+');
                foreach ($list as $fields) {               
                    fputcsv($file, $fields);
                    }
                fclose($file);

            }            
    }    else{
        $errorpassord=$errorlanguepassword;
    }
}



?>