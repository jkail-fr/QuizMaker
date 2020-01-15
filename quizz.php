<!-- Partie PHP -->

<?php
// connexion à la BDD
require_once('includes/sqlconnect.php');

//var_dump($_POST);

//Affichage questions pour quizz

if((isset($_POST['cat']) AND isset ($_POST['niv']) AND $_POST['cat'] == "random"))
        {
            $i = 0;
            $questionmax = 4;
            $result = $bdd->query('SELECT * FROM `qanda` WHERE niveau LIKE "%'.$_POST['niv'].'%" ORDER BY RAND()');
            while($donnees = $result->fetch() AND $i<=$questionmax)
            {
                switch ($_POST['niv'])
                {
                    case 1 : echo $donnees['question'].'<br>'.$donnees['bonne_reponse'].'<br>'.$donnees['facile'] ;
                    break;

                    case 2 : echo $donnees['question'].'<br>'.$donnees['bonne_reponse'].'<br>'.$donnees['facile'].'<br>'.$donnees['intermediaire'] ;
                    break;

                    case 3 : echo $donnees['question'].'<br>'.$donnees['bonne_reponse'].'<br>'.$donnees['facile'].'<br>'.$donnees['intermediaire'].'<br>'.$donnees['expert'] ;
                    break;

                }

                $i++;
            }
        }


else if(isset($_POST['cat']) AND isset ($_POST['niv']))
    {
        // echo 5 questions parmi la catégorie et le niveau retenus
        $i = 0;
        $questionmax = 4;
        $result = $bdd->query('SELECT * FROM `qanda` WHERE categorie LIKE "%'.$_POST['cat'].'%" AND niveau LIKE "%'.$_POST['niv'].'%" ORDER BY RAND()');
        while($donnees = $result->fetch() AND $i<=$questionmax)
            {
                switch ($_POST['niv'])
                {
                    case 1 : echo $donnees['question'].'<br>'.$donnees['bonne_reponse'].'<br>'.$donnees['facile'] ;
                    break;

                    case 2 : echo $donnees['question'].'<br>'.$donnees['bonne_reponse'].'<br>'.$donnees['facile'].'<br>'.$donnees['intermediaire'] ;
                    break;

                    case 3 : echo $donnees['question'].'<br>'.$donnees['bonne_reponse'].'<br>'.$donnees['facile'].'<br>'.$donnees['intermediaire'].'<br>'.$donnees['expert'] ;
                    break;

                }

                $i++;
            }
    }

else
    {
        echo "Vous n'avez pas sélectionné de niveau et/ou de catégorie";
    }

?>
