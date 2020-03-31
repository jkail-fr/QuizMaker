<?php
session_start();

// Réponses dans l'ordre de la table MySQL
$currentQuizz = $_SESSION["repCorrectes"];
// Réponses dans l'ordre affiché lors du quizz au joueur
$affichageQuestions = $_SESSION["repUtilisateur"];
// Nombre maximum de questions
$questionMax = $_SESSION["questionmax"];

// On récupère les réponses du joueur
$reponseJoueur = $_POST;
// var_dump($reponseJoueur);
array_splice($reponseJoueur, 0, 0);

//On récupère $cat et $niv pour le bouton qui relance le même type de quizz
$cat = $_POST['cat'];
$niv = $_POST['niv'];
var_dump($cat, $niv);

// Inclusion du html
require_once('views/include/head.php');
echo '<link rel="stylesheet" href="css/quizz.css" />';
echo '<title> Mon titre </title>';

require_once('views/include/body.php');

// On réaffiche les questions et les réponses données par le joueur
$position = 0;
$total = 0;
foreach ($affichageQuestions as $question) {
    // var_dump($question);

?>

    <div class="question">
        <hr> <!-- à enlever à la fin -->
        <?= $currentQuizz[$position][2] ?> <br>
    </div>

    <div class="reponses">
        <!-- disabled = permet d'empêcher le joueur de modifier sa sélection lors de l'affichage des réponses -->
        <input type="radio" name="<?= $currentQuizz[$position][0] ?>" value="<?= $currentQuizz[$position][3] ?>" <?php if ($currentQuizz[$position][3] == $reponseJoueur[$position]) {
                                                                                                                        echo 'checked';
                                                                                                                    } ?> disabled>
        <label for="<?= $currentQuizz[$position][0] ?>" <?php if ($currentQuizz[$position][3] == $question[0]) {
                                                            echo 'class ="correct"';
                                                        } else {
                                                            echo 'class ="incorrect"';
                                                        } ?>><?= $question[0] ?>
        </label>
        <br>
        <input type="radio" name="<?= $currentQuizz[$position][0] ?>" value="<?= $currentQuizz[$position][4] ?>" <?php if ($currentQuizz[$position][4] == $reponseJoueur[$position]) {
                                                                                                                        echo 'checked';
                                                                                                                    } ?> disabled>
        <label for="<?= $currentQuizz[$position][0] ?>" <?php if ($currentQuizz[$position][3] == $question[1]) {
                                                            echo 'class ="correct"';
                                                        } else {
                                                            echo 'class ="incorrect"';
                                                        } ?>><?= $question[1] ?>
        </label>
        <br>

        <?php if (isset($currentQuizz[$position][5])) { ?>
            <input type="radio" name="<?= $currentQuizz[$position][0] ?>" value="<?= $currentQuizz[$position][5] ?>" <?php if ($currentQuizz[$position][5] == $reponseJoueur[$position]) {
                                                                                                                            echo 'checked';
                                                                                                                        } ?> disabled>
            <label for="<?= $currentQuizz[$position][0] ?>" <?php if ($currentQuizz[$position][3] == $question[2]) {
                                                                echo 'class ="correct"';
                                                            } else {
                                                                echo 'class ="incorrect"';
                                                            } ?>><?= $question[2] ?>
            </label>
            <br>
        <?php
        }
        if (isset($currentQuizz[$position][6])) { ?>
            <input type="radio" name="<?= $currentQuizz[$position][0] ?>" value="<?= $currentQuizz[$position][6] ?>" <?php if ($currentQuizz[$position][6] == $reponseJoueur[$position]) {
                                                                                                                            echo 'checked';
                                                                                                                        } ?> disabled>
            <label for="<?= $currentQuizz[$position][0] ?>" <?php if ($currentQuizz[$position][3] == $question[3]) {
                                                                echo 'class ="correct"';
                                                            } else {
                                                                echo 'class ="incorrect"';
                                                            } ?>><?= $question[3] ?>
            </label>
        <?php
        } ?>

        <!-- Affichage du feedback -->
        <br>
        <div class="feedback">
            <h4>Correction : </h4><?= $currentQuizz[$position][1] ?>
        </div>

        <?php


        // Calcul du résultat total
        switch (true) {
                // Pour chaque cas, on vérifie si la case checkée correspond à la bonne réponse
            case ($currentQuizz[$position][3] == $reponseJoueur[$position] && $currentQuizz[$position][3] == $question[0]):
                $total += 1;
                break;
            case ($currentQuizz[$position][4] == $reponseJoueur[$position] && $currentQuizz[$position][3] == $question[1]):
                $total += 1;
                break;
            case ($currentQuizz[$position][5] == $reponseJoueur[$position] && $currentQuizz[$position][3] == $question[2]):
                $total += 1;
                break;
            case ($currentQuizz[$position][6] == $reponseJoueur[$position] && $currentQuizz[$position][3] == $question[3]):
                $total += 1;
                break;
        }

        $position++;
        ?>
    </div>

<?php
}
echo 'Votre résultat est de ' . $total . '/' . $questionMax . '.';
?>
<form action="quizz.php" method="POST">
    <input type="hidden" value="<?= $cat ?>" name="cat">
    <input type="hidden" value="<?= $niv ?>" name="niv">
    <input type="submit" value="Recommencer le questionnaire" />
</form>

<a href="index.php"> <button>Revenir à l'accueil pour choisir un autre quizz </button></a>
