<!-- Partie PHP -->

<?php
// connexion à la BDD
require_once('includes/sqlconnect.php');

//Affichage questions pour quizz

//Cas d'un choix de quizz aléatoire
if((isset($_POST['cat']) AND isset ($_POST['niv']) AND $_POST['cat'] == "random"))
        {

            $result = $bdd->query('SELECT * FROM `qanda` WHERE niveau LIKE "%'.$_POST['niv'].'%" ORDER BY RAND()');
        }

//Cas d'un choix de quizz avec catégorie et niveaux
else
    {
        $result = $bdd->query('SELECT * FROM `qanda` WHERE categorie LIKE "%'.$_POST['cat'].'%" AND niveau LIKE "%'.$_POST['niv'].'%" ORDER BY RAND()');
    }


require_once('views/include/head.php');
echo '<link rel="stylesheet" href="css/quizz.css" />';
echo '<title> Mon titre </title>';

require_once('views/include/body.php');?>

    <h1>Début du quizz</h1>
    <p> Vous avez 10 questions, bon courage ! </p>

<?php
    // cas d'une personne saisissant directement l'URL de la page
    if (!isset($_POST['cat']) OR !isset($_POST['niv']))
        {
            echo "Vous n'avez pas sélectionné de niveau et/ou de catégorie";
        }
    // cas d'une personne sélectionnant correctement le quizz
    else
        {
            $i = 0;
            $questionmax = 10;
            $currentQuizz = [];

            // Récupère les données des questions et les stocke dans un array
            while($donnees = $result->fetch() AND $i<=$questionmax)
                {
                    switch ($_POST['niv'])
                        {
                            case 1 :
                            $easyQuizz = [$donnees['ID'], $donnees['feedback'], $donnees['question'], $donnees['bonne_reponse'], $donnees['facile']];
                            $currentQuizz[$i] = $easyQuizz;
                            break;

                            case 2 :
                            $mediumQuizz = [$donnees['ID'], $donnees['feedback'], $donnees['question'], $donnees['bonne_reponse'], $donnees['facile'], $donnees['intermediaire']];
                            $currentQuizz[$i] = $mediumQuizz;
                            break;

                            case 3 :
                            $hardQuizz = [$donnees['ID'], $donnees['feedback'], $donnees['question'], $donnees['bonne_reponse'], $donnees['facile'], $donnees['intermediaire'], $donnees['expert']];
                            $currentQuizz[$i] = $hardQuizz;
                            break;
                        }
                    $i++;
                }

            // Créé la boucle générale qui va permettre de gérer l'affichage
            $j = 0;
            while($j < count($currentQuizz))
                {?>

                    <div class="newquestion">
                        <div class="question">
                                <hr> <!-- à enlever à la fin -->
                                <?= $currentQuizz[$j][2]?> <br>
                        </div>
<?php

                    // On récupère les index des questions dans l'array
                    $reponseaffichage = array_slice($currentQuizz[$j], 3);
                    shuffle($reponseaffichage);
                    var_dump($reponseaffichage); ?>

<!-- arriver à afficher les réponses dans les "cases" (cf. foreach) et comment vérifier la bonne réponse ? (comparaison de valeur) -->
                        <div class="reponse">
                            <input type="radio" name="<?= $currentQuizz[$j][0]?>" value="<?= $currentQuizz[$j][3]?>">
                            <label for="<?= $currentQuizz[$j][0]?>"><?= $currentQuizz[$j][3]?></label><br>
                            <br>
                            <input type="radio" name="<?= $currentQuizz[$j][0]?>" value="<?= $currentQuizz[$j][4]?>">
                            <label for="<?= $currentQuizz[$j][0]?>"><?= $currentQuizz[$j][4]?></label><br>
                            <br>
                            <?php if(isset($currentQuizz[$j][5]))
                            { ?>
                                <input type="radio" name="<?= $currentQuizz[$j][0]?>" value="<?= $currentQuizz[$j][5]?>">
                                <label for="<?= $currentQuizz[$j][0]?>"><?= $currentQuizz[$j][5]?></label><br>
                                <br>
                            <?php
                            }
                            if(isset($currentQuizz[$j][6]))
                            { ?>
                                <input type="radio" name="<?= $currentQuizz[$j][0]?>" value="<?= $currentQuizz[$j][6]?>">
                                <label for="<?= $currentQuizz[$j][0]?>"><?= $currentQuizz[$j][6]?></label><br>
                            <?php
                            } ?>
                            <br> -->
                        </div>
                    </div>
                <?php
                $j++;
                }
        }
require_once('views/include/end.php');
?>
