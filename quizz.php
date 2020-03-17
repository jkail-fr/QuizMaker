<!-- Partie PHP -->

<?php
// connexion à la BDD
require_once('includes/sqlconnect.php');
session_start();

//Affichage questions pour quizz
//Cas d'un choix de quizz aléatoire
if ((isset($_POST['cat']) and isset($_POST['niv']) and $_POST['cat'] == "random")) {

    $result = $bdd->query('SELECT * FROM `qanda` WHERE niveau LIKE "%' . $_POST['niv'] . '%" ORDER BY RAND()');
}

//Cas d'un choix de quizz avec catégorie et niveaux
else {
    $result = $bdd->query('SELECT * FROM `qanda` WHERE categorie LIKE "%' . $_POST['cat'] . '%" AND niveau LIKE "%' . $_POST['niv'] . '%" ORDER BY RAND()');
}

require_once('views/include/head.php');
echo '<link rel="stylesheet" href="css/quizz.css" />';
echo '<title> Mon titre </title>';

require_once('views/include/body.php'); ?>

<h1>Début du quizz</h1>
<p> Vous avez 10 questions, bon courage ! </p>

<?php
// cas d'une personne saisissant directement l'URL de la page
if (!isset($_POST['cat']) or !isset($_POST['niv'])) {
    echo "Vous n'avez pas sélectionné de niveau et/ou de catégorie";
}
// cas d'une personne sélectionnant correctement le quizz
else {
?>
    <form action="correction.php" method="POST">
        <?php
        $i = 0;
        $questionmax = 10;
        $currentQuizz = [];

        // Récupère les données des questions et les stocke dans un array - on positionne les valeurs fixes en premier pour pouvoir faire un slice plus tard
        while ($donnees = $result->fetch() and $i <= $questionmax) {
            switch ($_POST['niv']) {
                case 1:
                    $quizz = [$donnees['ID'], $donnees['feedback'], $donnees['question'], $donnees['bonne_reponse'], $donnees['facile']];
                    $currentQuizz[$i] = $quizz;
                    break;

                case 2:
                    $quizz = [$donnees['ID'], $donnees['feedback'], $donnees['question'], $donnees['bonne_reponse'], $donnees['facile'], $donnees['intermediaire']];
                    $currentQuizz[$i] = $quizz;
                    break;

                case 3:
                    $quizz = [$donnees['ID'], $donnees['feedback'], $donnees['question'], $donnees['bonne_reponse'], $donnees['facile'], $donnees['intermediaire'], $donnees['expert']];
                    $currentQuizz[$i] = $quizz;
                    break;
            }
            $i++;
        }

        //On extrait les réponses et on les mélange (les réponses, pas l'ordre d'affichage)
        $j = 0;
        $affichageQuestions = array();

        while ($j < count($currentQuizz) and $j < 10) {
            $sliceArray = array_slice($currentQuizz[$j], 3);
            shuffle($sliceArray);
            $affichageQuestions[] = $sliceArray;
            $j++;
        }

        // On stocke les données en session
        $_SESSION["repCorrectes"] = $currentQuizz;
        $_SESSION["repUtilisateur"] = $affichageQuestions;


        // on affiche les question
        $position = 0;
        foreach ($affichageQuestions as $question) { ?>

            <!-- Affichage de la question -->
            <div class="question">
                <hr> <!-- à enlever à la fin -->
                <?= $currentQuizz[$position][2] ?> <br>
            </div>

            <!-- Affichage des réponses -->
            <div class="reponses">

                <!-- Affichage des réponses 1 et 2 -->
                <input type="radio" name="<?= $currentQuizz[$position][0] ?>" value="<?= $currentQuizz[$position][3] ?>">
                <label for="<?= $currentQuizz[$position][0] ?>"><?= $question[0] ?></label>
                <br>
                <input type="radio" name="<?= $currentQuizz[$position][0] ?>" value="<?= $currentQuizz[$position][4] ?>">
                <label for="<?= $currentQuizz[$position][0] ?>"><?= $question[1] ?></label>
                <br>

                <!-- Affichage de la réponse 3 -->
                <?php if (isset($currentQuizz[$position][5])) { ?>
                    <input type="radio" name="<?= $currentQuizz[$position][0] ?>" value="<?= $currentQuizz[$position][5] ?>">
                    <label for="<?= $currentQuizz[$position][0] ?>"><?= $question[2] ?></label>
                    <br>
                <?php
                }
                // Affichage de la réponse 4
                if (isset($currentQuizz[$position][6])) { ?>
                    <input type="radio" name="<?= $currentQuizz[$position][0] ?>" value="<?= $currentQuizz[$position][6] ?>">
                    <label for="<?= $currentQuizz[$position][0] ?>"><?= $question[3] ?></label>

                <?php
                }

                $position++;
                ?>

            </div>

        <?php
        }
        ?>

        <button type="submit">Valider le quizz</button>
    </form>

<?php
}
require_once('views/include/end.php');
?>
