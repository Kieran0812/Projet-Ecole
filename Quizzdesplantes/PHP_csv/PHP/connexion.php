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
                //Si $_POST=it on inclut le fichier de langue italien
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

//touts les les variable de type $*nom* doivent être changer par leur valeur défénitive
//ainsi que toute les valeurs de type '*valeur*' doivent être changer 


//gestion deconnexion

if($_GET) {
    if(isset($_GET['deconame'])&&($_GET['deconame'])){
        unset ($_SESSION['nomprenom']);
        session_destroy();
        $_POST['remember']=0;
        setcookie('remember',NULL,0,"/");
        header("location:index.php");
    }
}
//fin gestion deconnexion
// gestion du cookie de connection
require_once("function.php");
// gestion cookies
if(isset($_COOKIE['remember'])&&$_COOKIE['remember']){
$cookiesss=readCsv('../CSV/user.csv',",");
foreach ($cookiesss as $value) {
    if (password_verify($value[0].$value[1].$value[2],$_COOKIE['remember'])){
        $_SESSION['nomprenom']=$value[0]." ".$value[1];
    }
}
}
// gestion de création de cookie de connection
if ($_POST){
    if (isset($_SESSION['nomprenom'])){
        if ($_POST['remember']==1){
            $cript=cript();
            setcookie('remember',$cript,time()+(86400), "/");
        }
    }
}
// fin gestion du cookie de connection
// verification de connexion sans cookie
$verif="";
$erroboth_exist=false;
$errorpassword_exist=false;
$errorboth="";
$errorpassword="";
$lire=readCsv('../CSV/user.csv',",");
//verification si compte existe
if (isset($_POST)&&$_POST){
        for ($i=0;$i<count($lire);$i++){
            if ($_POST['email']==$lire[$i][2]){
                $password=$lire[$i][3];
                //verification du mot de passe associe
                if(password_verify($_POST['password'],$password)){
                    $_SESSION['nomprenom']=$lire[$i][0]." ".$lire[$i][1];
                    header("location:index.php");
                }
                else{
                    $errorpassword_exist=true;
                }
            }
            else {
                $erroboth_exist=true;
            }
        }
    }
if (isset($_POST['email'])){
    if ($errorpassword_exist==true) {
        $errorpassword=$errorpass;         
        } else {
             $errorboth=$errorm;
    }
}
// fin verification de connexion sans cookie
?>