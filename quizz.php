<!-- Partie PHP -->

<?php
// connexion à la BDD
require_once('includes/sqlconnect.php');

//var_dump($_POST);

//Affichage questions pour quizz

if(isset($_POST['cat']) AND isset ($_POST['niv']))
    {
        // echo 5 questions parmi la catégorie et le niveau retenus
        $result = $bdd->query('SELECT * FROM `qanda` WHERE categorie='.$_POST['cat'].' AND niveau='.$_POST['niv'].'');
        while($donnees = $result->fetch())
            {
                echo $donnees['question'];
            }
        //var_dump($result);
    }

else
    {
        echo "Vous n'avez pas sélectionné de niveau et/ou de catégorie";
    }

?>
