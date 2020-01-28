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
            while($donnees = $result->fetch() AND $i<=$questionmax)

                switch ($_POST['niv'])
                    {
                        case 1 :
                            $$donnees['ID'] =
                                [
                                    $donnees['ID'],
                                    $donnees['feedback'],
                                    $donnees['question'],
                                    $donnees['bonne_reponse'],
                                    $donnees['facile']
                                ];
                        break;

                        case 2 :
                            $$donnees['ID'] =
                                [
                                    $donnees['ID'],
                                    $donnees['feedback'],
                                    $donnees['question'],
                                    $donnees['bonne_reponse'],
                                    $donnees['facile'],
                                    $donnees['intermediaire']
                                ];
                        break;

                        case 3 :
                            $$donnees['ID'] =
                                [
                                    $donnees['ID'],
                                    $donnees['feedback'],
                                    $donnees['question'],
                                    $donnees['bonne_reponse'],
                                    $donnees['facile'],
                                    $donnees['intermediaire'],
                                    $donnees['expert']
                                ];
                        break;

                    }
                $i++;
        }

require_once('views/include/end.php');
?>
