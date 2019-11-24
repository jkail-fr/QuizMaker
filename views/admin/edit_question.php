<?php

// connexion à la BDD
require_once('../../includes/sqlconnect.php');

// fonction d'update pour chaque nouveau contenu au cas où un champ est modifié
function updatechampsql($old, $new, $connect, $champsql, $id)
    {
        if($old != $new)
        {
            $req = $bdd->prepare('UPDATE qanda SET question=:new WHERE id=:id');
            $ex = $req-> execute(array('new' => $new , 'id' => $id));
        }
    }

// update du nouveau contenu
if (isset($_POST['newquestion']))
    {
        $id = $_POST['id'];
        $newquestion = $_POST['newquestion'];
        $question = $_POST['question'];
        updatechampsql($question, $newquestion, $bdd, 'question', $id);
    }

if (isset($_POST['Modifier']) OR (isset($_POST['newquestion'])))
    {

        if (isset($_POST['Modifier']))
            {
               $id = $_POST['Modifier'];
            }

        $req = $bdd->prepare('SELECT * FROM `qanda` WHERE ID=:id');
        $ex = $req-> execute(array('id' => $id));
        while($donnees = $req->fetch())
            {
                $id = $donnees['ID'];
                $question = $donnees['question'];
                $categorie = json_decode($donnees['categorie']);
                $niveau = json_decode($donnees['niveau']);
                $bonnereponse = $donnees['bonne_reponse'];
                $facile = $donnees['facile'];
                $intermediaire = $donnees['intermediaire'];
                $expert = $donnees['expert'];
                $feedback = $donnees['feedback'];
            }
        //$req->closeCursor ();
        ?>


<h2> Question à modifier </h2>

<p>
    <a href="./manage_questions.php"> Retour à la liste des questions</a>
</p>

<form action='#' method="POST">

    <!-- On récupère les variables POST pour les comparer après -->
        <input type="hidden" name="id" value ="<?php echo $id; ?>" />
        <input type="hidden" name="question" value ="<?php echo $question; ?>" />
        <!--<input type="hidden" name="categorie" value ="<?php //echo $categorie; ?>" />-->
        <input type="hidden" name="bonnereponse" value ="<?php echo $bonnereponse; ?>" />
        <input type="hidden" name="facile" value ="<?php echo $facile; ?>" />
        <input type="hidden" name="intermediaire" value ="<?php echo $intermediaire; ?>" />
        <input type="hidden" name="expert" value ="<?php echo $feedback; ?>" />

    <!-- Affichage des données -->
    <table>
        <tr>
            <td><label for="question">Question</label> : </td>
            <td><input id="question" type="text" size ="100%" name="newquestion" value="<?php echo $question; ?>"/></td>
        </tr>

        <tr>
            <td><label for="categorie">Catégorie</label> : </td>
            <td>
                    <?php
                    $reponse = $bdd->query('SELECT * FROM `categories`');
                    while($donnees = $reponse->fetch())
                        {
                            ?>
                            <input type="checkbox" id="<?php echo $donnees['ID_Cat']; ?>" name="newchoix[]" value="<?php echo $donnees['ID_Cat']; ?>"
                                <?php
                                    if (in_array($donnees['ID_Cat'], $categorie))
                                        {
                                          echo "checked";
                                        }
                                ?>
                            />
                            <label for="<?php echo $donnees['ID_Cat']; ?>"><?php echo $donnees['noms']; ?></label><br>
                            <?php
                        }
                        $reponse->closeCursor ();
                    ?>
            </td>
        </tr>

        <tr>
            <td><label for="niveau">Niveau</label> : </td>
            <td><input id="niveau" type="text" size ="100%" name="newniveau" value=""/></td>
        </tr>

        <tr>
            <td><label for="bonnereponse">Bonne réponse</label> : </td>
            <td><input id="bonnereponse" type="text" size ="100%" name="newbonnereponse" value="<?php echo $bonnereponse; ?>"/></td>
        </tr>

        <tr>
            <td><label for="facile">Réponse facile</label> : </td>
            <td><input id="facile" type="text" size ="100%" name="newfacile" value="<?php echo $facile; ?>"/></td>
        </tr>

        <tr>
            <td><label for="intermediaire">Réponse intermédiaire</label> : </td>
            <td><input id="intermediaire" type="text" size ="100%" name="newintermediaire" value="<?php echo $intermediaire; ?>"/></td>
        </tr>

        <tr>
            <td><label for="expert">Réponse expert</label> : </td>
            <td><input id="expert" type="text" size ="100%" name="newexpert" value="<?php echo $expert; ?>"/></td>
        </tr>

        <tr>
            <td><label for="feedback">Feedback</label> : </td>
            <td><input id="feedback" type="text" size ="100%" name="newfeedback" value="<?php echo $feedback; ?>"/></td>
        </tr>
    </table>

    <?php

    ?>

    <div id="modifierquestion">
        <button type="submit" >Valider la modification</button>
    </div>
</form>

<?php
    }


else
    {
        echo "vous n'avez pas sélectionné de question";
    }

?>
