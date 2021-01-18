<?php
	session_start();
	ini_set('display_errors', 'off');
	require("inscription.php");
	require("connexion.php");
	unset ($_SESSION["num_question"]);
// calcule chrono
if (isset($_SESSION["chrono"])&&$_SESSION["chrono"]){
	//calcule de temps
	$timeh=(date('H')- date("H",strtotime($_SESSION["timer_debut"])));//donne heure
	$timem=(date('i')- date("i",strtotime($_SESSION["timer_debut"])));//donne minute
	$times=(date('s')- date("s",strtotime($_SESSION["timer_debut"])));//donne seconde
	if ($timeh>=1){
		$time=$timeh."h".$timem."m".$times."s";
	}
	else{
		$time=$timem."m".$times."s";
	}     
	//print $time;
}

if (isset($_SESSION["timer_debut"])&&$_SESSION["timer_debut"]){
	
}
// controle des réponces 
$_20=0;

for ($i=1; $i <= 20 ; $i++) { 
	if($_SESSION['reponse'.$i]==$_SESSION['question_complet'.$i][2]){
		$_20++;
		${"juste".$i}=true;
	}
	else{
		${"juste".$i}=false;
		${"type".$i}=$_SESSION['question_complet'.$i][0];
	}
}
if(isset ($_SESSION['lang']) && $_SESSION['lang']){
	switch($_SESSION['lang']){ // selectionne la langue
            default:
            case 'fr':
                include('francais.php');
            break;
            case 'en':
                include('english.php');
            break;
    	}
	}else {
		include ("francais.php");
		$_SESSION['lang']='fr';
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Quizz Plants</title>
	<link rel="stylesheet" type="text/css" href="../../css/reponse.css">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<header>		
		<div id="tete">
			<a href="resultat.php?lang=<?php if (isset ($_GET['lang']) && $_GET['lang']) print $_GET['lang']; else print 'fr';?>&deconame=1"><button type="button" name="deconame" id="btd"><?php print $_SESSION['nomprenom']; ?><i class="fas fa-user-slash"></i></button></a>
		</div>
		<h1><!--traduction et affichage chrono-->
		<?php print $_resultat; ?><br>
		<?php if (isset($_SESSION["chrono"])&&$_SESSION["chrono"]){
			print $tempschrono ; 
			print $time; 
			unset ($_SESSION["chrono"]);}?>
		</h1>

	</header>
	<section>
	<?php for ($i=1; $i <= 20 ; $i++) {
			if (${"juste".$i}==false){  ?>
		<p><?php print $_SESSION['question_complet'.$i][1]?></p>
				<?php switch (${"type".$i}){
					case "typea":?>
					<div class="reponse"><?php print $labonnereponse?></div>
					<div id="imgbon"><img src="../../images/image_tableau/<?php print $_SESSION['question_complet'.$i][2]?>"></div>
					<div class="reponse"><?php print $votrereponce?></div>
					<div id="imgrep"><img src="../../images/image_tableau/<?php print $_SESSION['reponse'.$i]?>"></div>
					<?php break;
					case "typeb": ?>
						<ul>
							<li><?php print $labonnereponse?></li>
							<li style="color:green"><?php print $_SESSION['question_complet'.$i][2]?></li>
							<li><?php print $votrereponce?></li>
							<li style="color:red"><?php print $_SESSION['reponse'.$i]?></li>
						</ul> 
					<?php break;}}}?>
			<p>Note : <?php print $_20?>/20</p>	
			<a href="index.php?lang=<?php if (isset ($_SESSION['lang']) && $_SESSION['lang']) print $_SESSION['lang']; else print 'fr' ?>"><button id="retour"><?php print $_return ?></button></a>
	</section>
	<footer>
		<h3><?php print $_developper ?></h3>
		<ul>
			<li>Esteban</li>
			<li>Kieran</li>
			<li>Damien</li>
		</ul>
	</footer>
	<?php 
        for ($i=0; $i < 20 ; $i++) { 
            unset ($_SESSION['question_complet'.$i]);
            unset ($_SESSION['reponse'.$i]);
        }
    ?>
</body>
</html>