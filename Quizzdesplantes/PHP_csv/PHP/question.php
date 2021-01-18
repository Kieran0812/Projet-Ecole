<?php
    session_start();
    ini_set('display_errors', 'off');
    require_once ("rand.php"); // func

    if (isset($_SESSION["num_question"])&&$_SESSION["num_question"]){ //gestion num de la question
        if ($_SESSION["num_question"]==20){ // quand arrive a 6 question, va au resultat
            $_SESSION['reponse'.$_SESSION["num_question"]]=$_GET['button'];
            header('Location: resultat.php');
            exit();
        }
        else{
            $_SESSION['reponse'.$_SESSION["num_question"]]=$_GET['button'];
            $_SESSION["num_question"]++;
        }
    }else{
        $_SESSION["num_question"]=1; // initialisation
        if ($_GET["chrono"]=='yes'){
            $_SESSION["timer_debut"] = date("H:i:s"); //début timer
            $_SESSION["chrono"] = "yes";
        }
    }?>
    <span>Question <?php print $_SESSION["num_question"]; ?></span>

<?php   $question_type=rand(1,2); // randomise le type de question

    switch ($question_type) {
        case 1:
            $question_complet=question_type_a(); // array qui contient tout les infos d'une question type_a
            $type=$question_complet[0];
            $question=$question_complet[1];
            $bonne_image=$question_complet[2];
            $mauvaise_image1=$question_complet[3];
            $mauvaise_image2=$question_complet[4];
            $mauvaise_image3=$question_complet[5];
            $categorie=$question_complet[6];
            break;

        case 2:
            $question_complet=question_type_b(); // array qui contient tout les infos d'une question type_b
            $type=$question_complet[0];
            $latin=$question_complet[1];
            $bon_nom=$question_complet[2];
            $mauvais_nom1=$question_complet[3];
            $mauvais_nom2=$question_complet[4];
            $mauvais_nom3=$question_complet[5];
            break;
        }
    $_SESSION['question_complet'.$_SESSION["num_question"]] = $question_complet; //met les infos d'une question dans la session 
    // print_r ($_SESSION['question_complet1']);

// print_r ($question_complet);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/question.css">
    <title>Quizz Plants</title>
</head>
<body>
    <?php 
        $tableau_ordre=array(); // pour rand ordre de réponse
        $tableau_ordre[0]=$question_complet[rand(2,5)];
        $tableau_ordre[1]=$tableau_ordre[0];
        $tableau_ordre[2]=$tableau_ordre[0];
        $tableau_ordre[3]=$tableau_ordre[0];
        while ($tableau_ordre[1]==$tableau_ordre[0]){
            $tableau_ordre[1]=$question_complet[rand(2,5)];
        }
        while ($tableau_ordre[2]==$tableau_ordre[0]||$tableau_ordre[2]==$tableau_ordre[1]){
            $tableau_ordre[2]=$question_complet[rand(2,5)];
        }
        while ($tableau_ordre[3]==$tableau_ordre[0]||$tableau_ordre[3]==$tableau_ordre[1]||$tableau_ordre[3]==$tableau_ordre[2]){
            $tableau_ordre[3]=$question_complet[rand(2,5)];
        }

        switch ($type) { //affiche question/reponce type a
            case "typea":?>
            <main>
                <div class="question">
                    <?php print $question ?>
                </div>
                <form id="img">
                    <div class="typea">
                        <button name="button" class="btypea" value="<?php print $tableau_ordre[0] ?>"><img src="../../images/image_tableau/<?php print $tableau_ordre[0] ?>"></button>
                    </div>
                    <div class="typea">
                        <button name="button" class="btypea" value="<?php print $tableau_ordre[1] ?>"><img src="../../images/image_tableau/<?php print $tableau_ordre[1] ?>"></button>
                    </div>
                    <div class="typea">
                        <button name="button" class="btypea" value="<?php print $tableau_ordre[2] ?>"><img src="../../images/image_tableau/<?php print $tableau_ordre[2] ?>"></button>
                    </div>
                    <div class="typea">
                        <button name="button" class="btypea" value="<?php print $tableau_ordre[3] ?>"><img src="../../images/image_tableau/<?php print $tableau_ordre[3] ?>"></button>
                    </div>
                </form>
            
                <?php break;
            case "typeb": //affiche question/reponce type b ?>
                <div class="question">
                    <?php print $latin ?>
                </div>
                <form id="bt">
                    <div class="typeb">
                        <button name="button" class="btypeb" value="<?php print $tableau_ordre[0] ?>"><?php print $tableau_ordre[0] ?></button>
                    </div>
                    <div class="typeb">
                        <button name="button" class="btypeb" value="<?php print $tableau_ordre[1] ?>"><?php print $tableau_ordre[1] ?></button>
                    </div>
                    <div class="typeb">
                        <button name="button" class="btypeb" value="<?php print $tableau_ordre[2] ?>"><?php print $tableau_ordre[2] ?></button>
                    </div>
                    <div class="typeb">
                        <button name="button" class="btypeb" value="<?php print $tableau_ordre[3] ?>"><?php print $tableau_ordre[3] ?></button>
                    </div>
                </form>
            </main>
                <?php break;
        } 
    ?>


</body>
</html>
