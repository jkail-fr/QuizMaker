<?php
// connexion à la BDD
require_once('../../includes/sqlconnect.php');



//Ajout d'une nouvelle question
if(isset($_POST['newquestion']))
    {
        $newquest = $_POST['newquestion'];
        $req = $bdd->prepare("INSERT INTO qanda(question) VALUES(:newquest)");
        $ex = $req-> execute(array('newquest' => $newquest));
        statutRequete($ex, "nouvelle question ajoutée", "échec de l'action");

        //$checkedcat = $_POST['categories'];
        //var_dump ($checkedcat);


        //$checkedlevel = $_POST['niveaux'];
        //var_dump ($checkedlevel);
        //$req->closeCursor ();
    }
?>

 <?php
            $reponse = $bdd->query('SELECT * FROM `qanda` ORDER BY question ASC');
            while($donnees = $reponse->fetch())
                {
                    echo '<option value="'.$donnees['ID'].'">' . $donnees['question'] . '</option>' ;
                }
            $reponse->closeCursor ();
?>

<h1>Création d'une nouvelle question</h1>


<!-- formulaire de création d'une nouvelle question -->
<h2>Ajouter une nouvelle question</h2>

<form action='#' method="POST">

    <!-- Ajout du texte de la question -->
    <label for="newquestion">1. Entrez votre nouvelle question :</label>
    <!---<textarea id="newquestion" name="newquestion" placeholder="votre nouvelle question" rows="5" cols="33"></textarea> -->
    <input type="text" value="" name="newquestion" placeholder="votre nouvelle question"/>
<hr>

    <!-- Choix de la catégorie de chaque question -->
    Choisissez la ou les catégorie(s) correspondant à votre question : <br><br>
    <?php
            $reponse = $bdd->query('SELECT * FROM `categories` ORDER BY nom ASC');
            while($donnees = $reponse->fetch())
                {
                    echo '<input type="checkbox" name="categories[]" value="'.$donnees['ID'].'">' . $donnees['nom'] . '<br>';
                }
            $reponse->closeCursor ();
    ?>
<hr>

    <!-- Choix du niveau de chaque question -->
    Choisissez le ou les niveau(x) correspondant à votre question : <br><br>
    <?php
            $reponse = $bdd->query('SELECT * FROM `niveaux` ORDER BY ID ASC');
            while($donnees = $reponse->fetch())
                {
                    echo '<input type="checkbox" name="niveaux[]" value="'.$donnees['ID'].'">' . $donnees['nom'] . '<br>';
                }
            $reponse->closeCursor ();
    ?>
   <hr>

        <button type="submit">Ajouter</button>

</form>


