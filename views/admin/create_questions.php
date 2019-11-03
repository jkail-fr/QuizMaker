<?php
// connexion à la BDD
require_once('../../includes/sqlconnect.php');



//Ajout d'une nouvelle question
if(isset($_POST['newquestion']))
    {
        $newquest = $_POST['newquestion'];
        $selectedcat = $_POST['categories'];
        $checkedlevel = $_POST['niveaux'];
        $trueanswer = $_POST['bonnereponse'];
        $easyanswer = $_POST['reponsefacile'];
        $mediumanswer = $_POST['reponseintermediaire'];
        $expertanswer = $_POST['reponseexpert'];
        $feedback = $_POST['feedback'];

        $req = $bdd->prepare("INSERT INTO qanda(question, categorie, niveau, bonne_reponse, facile, intermediaire, expert, feedback) VALUES(:newquest, :selectedcat, :checkedlevel, :trueanswer, :easyanswer, :mediumanswer, :expertanswer, :feedback)");
        $ex = $req-> execute(array('newquest' => $newquest, 'selectedcat' => serialize($selectedcat), 'checkedlevel' => serialize($checkedlevel), 'trueanswer' => $trueanswer, 'easyanswer' => $easyanswer, 'mediumanswer' => $mediumanswer, 'expertanswer' => $expertanswer, 'feedback' => $feedback));
        statutRequete($ex, "nouvelle question ajoutée", "échec de l'action");
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
    <textarea id="newquestion" name="newquestion" placeholder="votre nouvelle question" rows="5" cols="33"></textarea>
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

    <input type="text" value="" name="bonnereponse" size = "50" placeholder="bonne réponse"/>
    <hr>

    <input type="text" value="" name="reponsefacile" size = "50" placeholder="réponse facile"/>
    <hr>

    <input type="text" value="" name="reponseintermediaire" size = "50" placeholder="réponse intermédiaire"/>
    <hr>

    <input type="text" value="" name="reponseexpert" size = "50" placeholder="réponse expert"/>
    <hr>

    <textarea id="feedback" name="feedback" placeholder="votre feedback" rows="10" cols="66"></textarea>
    <hr>
    <button type="submit">Ajouter</button>

</form>
