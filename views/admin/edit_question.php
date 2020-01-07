<?php

// connexion à la BDD
require_once('../../includes/sqlconnect.php');

// fonction d'update pour chaque nouveau contenu au cas où un champ est modifié
function updatechampsql($old, $new, $connect, $champsql, $id)
    {
       if ($old != $new)
        {
            $req = $connect->prepare('UPDATE qanda SET '.$champsql.'=:new WHERE id=:id');
            $ex = $req-> execute(array('new' => $new , 'id' => $id));
           statutRequete($ex, "question modifiée", "échec de l'action");
        }
    }

// update du nouveau contenu : remplacement de l'ancien contenu par le nouveau
if (isset($_POST['newquestion']))
    {
        $id = $_POST['id'];

        // remplacement champ question
        $newquestion = $_POST['newquestion'];
        $question = $_POST['question'];
        updatechampsql($question, $newquestion, $bdd, 'question', $id);

        // remplacement champ "categorie"
        $newcategorie = $_POST['newchoix'];
        $categorie = $_POST['categorie'];
        $newcategorieencode = json_encode($newcategorie);
        if ($categorie != $newcategorie)
            {
                updatechampsql($categorie, $newcategorieencode, $bdd, 'categorie', $id);
            }

        //remplacement champ "niveau"
        $newniveau = $_POST['newniveau'];
        $niveau = $_POST['niveau'];
        $newniveauencode = json_encode($newniveau);
        if ($niveau != $newniveau)
            {
                updatechampsql($niveau, $newniveauencode, $bdd, 'niveau', $id);
            }

        //remplacement champ "Bonne réponse"
        $newbonnereponse = $_POST['newbonnereponse'];
        $bonnereponse = $_POST['bonnereponse'];
        updatechampsql($bonnereponse, $newbonnereponse, $bdd, 'bonne_reponse', $id);

        //remplacement champ "Réponse facile"
        $newfacile = $_POST['newfacile'];
        $facile = $_POST['facile'];
        updatechampsql($facile, $newfacile, $bdd, 'facile', $id);

        //remplacement champ "Réponse intermédiaire"
        $newintermediaire = $_POST['newintermediaire'];
        $intermediaire = $_POST['intermediaire'];
        updatechampsql($intermediaire, $newintermediaire, $bdd, 'intermediaire', $id);

        //remplacement champ "Réponse expert"
        $newexpert = $_POST['newexpert'];
        $expert = $_POST['expert'];
        updatechampsql($expert, $newexpert, $bdd, 'expert', $id);

        //remplacement champ "Feedback"
        $newfeedback = $_POST['newfeedback'];
        $feedback = $_POST['feedback'];
        updatechampsql($feedback, $newfeedback, $bdd, 'feedback', $id);
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


<a href="index.html" class="retouracceuil"> Retour à l'accueil </a>

<h2> Question à modifier </h2>

<p>
    <a href="./manage_questions.php"> Retour à la liste des questions</a>
</p>

<form action='#' method="POST">

    <!-- On récupère les variables POST pour les comparer après -->
        <input type="hidden" name="id" value ="<?php echo $id; ?>" />
        <input type="hidden" name="question" value ="<?php echo $question; ?>" />
        <input type="hidden" name="categorie" value ="<?php echo json_decode($donnees['categorie']); ?>" />
        <input type="hidden" name="niveau" value ="<?php echo json_decode($donnees['niveau']); ?>" />
        <input type="hidden" name="bonnereponse" value ="<?php echo $bonnereponse; ?>" />
        <input type="hidden" name="facile" value ="<?php echo $facile; ?>" />
        <input type="hidden" name="intermediaire" value ="<?php echo $intermediaire; ?>" />
        <input type="hidden" name="expert" value ="<?php echo $expert; ?>" />
        <input type="hidden" name="feedback" value ="<?php echo $feedback; ?>" />

    <!-- Affichage des données -->
    <table>
        <tr>
            <td><label for="question">Question</label> : </td>
            <td><input id="question" type="text" size ="100%" name="newquestion" value="<?php echo $question; ?>" required/></td>
        </tr>

        <tr>
            <td><label for="categorie">Catégorie</label> : </td>
            <td>
                    <?php
                    $reponse = $bdd->query('SELECT * FROM `categories` ORDER BY noms ASC');
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
            <br>
            </td>
        </tr>

        <tr>
            <td><label for="niveau">Niveau</label> : </td>
            <td>
                <?php
                    $reponse = $bdd->query('SELECT * FROM `niveaux` ORDER BY ID_Niv ASC');
                    while($donnees = $reponse->fetch())
                    {
                        ?>
                        <input type="checkbox" id="<?php echo $donnees['ID_Niv']; ?>" name="newniveau[]" value="<?php echo $donnees['ID_Niv']; ?>"
                               <?php
                                    if (in_array($donnees['ID_Niv'], $niveau))
                                        {
                                          echo "checked";
                                        }
                                ?>
                        />
                        <label for="<?php echo $donnees['ID_Niv']; ?>"> <?php echo $donnees['nom']; ?> </label><br>
                        <?php
                    }
                    $reponse->closeCursor ();
                ?>
            <br>
            </td>
        </tr>

        <tr>
            <td><label for="bonnereponse">Bonne réponse</label> : </td>
            <td><input id="bonnereponse" type="text" size ="100%" name="newbonnereponse" value="<?php echo $bonnereponse; ?>" required/></td>
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
            <td><input id="feedback" type="text" size ="100%" name="newfeedback" value="<?php echo $feedback; ?>" required/></td>
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
