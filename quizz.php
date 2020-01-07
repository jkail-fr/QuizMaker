<!-- Partie PHP -->

<?php
// connexion à la BDD
require_once('includes/sqlconnect.php');

//var_dump($_POST);

//Affichage questions pour quizz

if(isset($_POST['cat']) AND isset ($_POST['niv']))
    {
        echo "toto";
    }

else
    {
        echo "Vous n'avez pas sélectionné de niveau et/ou de catégorie";
    }

?>
