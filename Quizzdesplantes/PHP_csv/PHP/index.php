<?php
	session_start();
	require("inscription.php");
	require("connexion.php");
	//controle de choix de langue 
	//détection automatique de la langue
	if(empty($_SESSION['langueauto'])){
		$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		$_SESSION['langueauto']=1;	
		$_SESSION['lang'] = $lang{0}.$lang{1};
	}
	//choix manuel de la langue	
	if($_GET){
	    if(isset ($_GET['lang']) && $_GET['lang']){
	        switch($_GET['lang']){
	        //Si $_POST=fr on inclut le fichier de langue française
	        default:
	        case 'fr':
	        	$_SESSION['lang']='fr';
	            include('francais.php');
	        break;
	        //Si $_POST=en on inclut le fichier de langue anglaise
	        case 'en':
	        	$_SESSION['lang']='en';
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
	}//else {
		//include ("francais.php");
		//$_SESSION['lang']='fr';
	//}
}//else {
	//include ("francais.php");
	//$_SESSION['lang']='fr';
//}
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
}//else {
		//include ("francais.php");
		//$_SESSION['lang']='fr';
//}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Quizz Plants</title>
	<link rel="shortcut icon" href="../../images/image_site/icone.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="../../css/accueil.css">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<header class="img">
		<?php if (isset($errorboth)) { ?>
			<div class="error">
				<?php print $errorboth ?>
			</div>
		<?php } ?>
		<?php if ($errorpassword) { ?>
			<div class="error">
				<?php print $errorpassword ?> 
			</div>
		<?php } ?>
		<?php if ($errormail) { ?>
			<div class="error">
				<?php print $errormail ?>
			</div>
		<?php } ?>
		<?php if ($errorpassord) { ?>
			<div class="error">
				<?php print $errorpassord ?>
			</div>
		<?php } ?>
		<div id="tete">
			<div class="dropdown">
				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php print $_langue ?>
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="index.php?lang=fr"><img src=../../images/image_site/français.png><?php print $_francais ?></a>
					<a class="dropdown-item" href="index.php?lang=en"><img src=../../images/image_site/anglais.png><?php print $_anglais ?></a>
					<a class="dropdown-item" href="#"><img src=../../images/image_site/allemand.png><?php print $_allemand ?></a>
					<a class="dropdown-item" href="#"><img src=../../images/image_site/italien.png><?php print $_italien ?></a>
					<a class="dropdown-item" href="#"><img src=../../images/image_site/espagnol.png><?php print $_espagnol ?></a>
					<a class="dropdown-item" href="#"><img src=../../images/image_site/portugal.png><?php print $_portugal ?></a>
				</div>
			</div>
			<div id="tete2">
			<!-- Button trigger modal -->
				<?php if(isset($_SESSION["nomprenom"])&&$_SESSION["nomprenom"]){
                    if ($_SESSION['nomprenom']) { ?>
		      				<a href="index.php?lang=<?php if (isset ($_GET['lang']) && $_GET['lang']) print $_GET['lang']; else print 'fr';?>&deconame=1"><button type="button" name="deconame" id="btd"><?php if(isset($_SESSION["nomprenom"])&&$_SESSION["nomprenom"]){print $_SESSION['nomprenom'];} ?><i class="fas fa-user-slash"></i></button></a>
						<?php } }else { ?>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1" id="bt"><?php print $_connect ?></button>
						<?php } ?>
				<?php if(isset($_SESSION["nomprenom"])&&$_SESSION["nomprenom"]){
                    if ($_SESSION['nomprenom']) { ?>
						<?php } }else { ?>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" id="bt"><?php print $_inscrit ?></button>
						<?php } ?>
			</div>
		</div>
		<div id="titre">
			<!-- logo -->
			<h1><?php print $_titre ?></h1><br>
			<span><?php print $_soustitre ?></span>
		</div>
	</header>
	<div id="plant"><i class="fab fa-pagelines fa-3x"></i></div>
	<div class="img" id="plante">
		<span><?php print $_trans1 ?></span>
	</div>
	<section>
		<h2><?php print $_description ?></h2>
		<p><?php print $_textdes ?></p>
	</section>
	<div class="img" id="arbre">
		<span><?php print $_trans2 ?></span>
	</div>
	<section>
		<h2><?php print $_choix ?></h2>
		<div id="quizz">
			<?php if (isset($_SESSION['nomprenom'])) { ?>
    			<a href="question.php?chrono=no" class="button button-sign-in popup-button" data-modal="popup"><button class="btq"><?php print $_btn ?></button></a>
    			<a href="question.php?chrono=yes" class="button button-sign-in popup-button" data-modal="popup"><button class="btq"><?php print $_btc ?></button></a>
    			<button class="btq" id="btq2"><?php print $_soon ?></button>
  			<?php } else { ?>
    			<button class="btq" id="btq2"><?php print $_btn ?></button>
    			<button class="btq" id="btq2"><?php print $_btc ?></button>
    			<button class="btq" id="btq2"><?php print $_soon ?></button>
  			<?php } ?>
		</div>
	</section>
	<div class="img" id="fleur">
		<span><?php print $_trans3 ?></span>
	</div>
	<aside>
		<h2><?php print $_commentaires ?></h2>
		<p><span>Elaina</span> : "Oh mon Dieu ! c'est Quizz Plantastic !"</p>
		<p><span>RealityCookie</span> : "Guérir le monde avec Quizz Plantastic"</p>
		<p><span>DylanVador</span> : "Il y a certaines choses qui ne s'achètent pas, pour tout le reste il y a Quizz Plantastic"</p>
		<p><span>Amasoft</span> : "Jérôme vous facilite la vie"</p>
		<p><span>Egiljorik</span> : "Ours !"</p>
	</aside>
	<div class="img" id="fin">
		<footer>
			<h3><?php print $_developper ?></h3>
			<ul>
				<li>Esteban</li>
				<li>Kieran</li>
				<li>Damien</li>
			</ul>
		</footer>
	</div>
	<!-- Modal -->
	
		<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		    		<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLabel"><?php print $_connexion ?></h5>
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		        			<span aria-hidden="true">&times;</span>
		        		</button>
		   	 		</div>
		   	 		<form method="post">
			      	<div class="modal-body">
			        	<input type="email" name="email" placeholder="<?php print $_email ?>" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required><br>
			        	<input type="password" name="password" placeholder="<?php print $_mdp ?>" id="mdp" pattern="(?=^.{8,}$)((?=.*\d)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
			        	<div id="check"><input type="checkbox" name="remember" value="1"><?php print $_stay ?></div>
			      	</div>
		      		<div class="modal-footer">
		      			<button type="submit" class="btn btn-primary" id="bt"><?php print $_connect ?></button>	
        				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="fermer"><?php print $_fermer ?></button>
					</div>
				</form>
			</div>
	    </div>
	</div>
	<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		    		<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLabel"><?php print $_inscription ?></h5>
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		        			<span aria-hidden="true">&times;</span>
		        		</button>
		   	 		</div>
		   	 		<form method="post">
			      	<div class="modal-body">
			      		<input type="text" name="nom" placeholder="<?php print $_nom ?>" id="nom" required><br>
			      		<input type="text" name="prenom" placeholder="<?php print $_prenom ?>" id="prenom" required>
			        	<input type="email" name="email" placeholder="<?php print $_email ?>" id="mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required><br>
			        	<input type="password" name="password" placeholder="<?php print $_mdp ?>" id="mdp1" pattern="(?=^.{8,}$)((?=.*\d)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
			        	<input type="password" name="repeatpassword" placeholder="<?php print $_mdp2 ?>" id="mdp2" pattern="(?=^.{8,}$)((?=.*\d)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br>
			      	</div>
		      		<div class="modal-footer">
		        		<button type="submit" name="submit" class="btn btn-primary" id="bt"><?php print $_inscrit ?></button>
        				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="fermer"><?php print $_fermer ?></button>
					</div>
				</form>
			</div>
	    </div>
	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>