<?php

// connexion à la BDD
require_once('../../includes/sqlconnect.php');



if (isset($_POST['Modifier']))
    {
        // récupération des données de la question à modifier
        $id = $_POST['Modifier'];
        $req = $bdd->prepare('SELECT * FROM `qanda` WHERE ID=:id');
        $ex = $req-> execute(array('id' => $id));
        while($donnees = $req->fetch())
            {
                $question = $donnees['question'];
                $categorie = json_decode($donnees['categorie']);
                $niveau = json_decode($donnees['niveau']);
                $bonnereponse = $donnees['bonne_reponse'];
                $facile = $donnees['facile'];
                $intermediaire = $donnees['intermediaire'];
                $expert = $donnees['expert'];
                $feedback = $donnees['feedback'];
            }
        $req->closeCursor ();
        ?>


<h2> Question à modifier </h2>

<form action='#' method="POST">
    <table>
        <tr>
            <td><label for="question">Question</label> : </td>
            <td><input id="question" type="text" size ="100%" name="question" value="<?php echo $question; ?>"/></td>
        </tr>

        <tr>
            <td><label for="categorie">Catégorie</label> : </td>
            <td>
                    <?php
                    var_dump($categorie);
                    $reponse = $bdd->query('SELECT * FROM `categories`');
                    while($donnees = $reponse->fetch())
                        {
                            ?>
                            <input type="checkbox" id="<?php echo $donnees['ID_Cat']; ?>" name="choix[]" value="<?php echo $donnees['ID_Cat']; ?>"
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
            <td><input id="niveau" type="text" size ="100%" name="niveau" value=""/></td>
        </tr>

        <tr>
            <td><label for="bonnereponse">Bonne réponse</label> : </td>
            <td><input id="bonnereponse" type="text" size ="100%" name="bonnereponse" value="<?php echo $bonnereponse; ?>"/></td>
        </tr>

        <tr>
            <td><label for="facile">Réponse facile</label> : </td>
            <td><input id="facile" type="text" size ="100%" name="facile" value="<?php echo $facile; ?>"/></td>
        </tr>

        <tr>
            <td><label for="intermediaire">Réponse intermédiaire</label> : </td>
            <td><input id="intermediaire" type="text" size ="100%" name="intermediaire" value="<?php echo $intermediaire; ?>"/></td>
        </tr>

        <tr>
            <td><label for="expert">Réponse expert</label> : </td>
            <td><input id="expert" type="text" size ="100%" name="expert" value="<?php echo $expert; ?>"/></td>
        </tr>

        <tr>
            <td><label for="feedback">Feedback</label> : </td>
            <td><input id="feedback" type="text" size ="100%" name="feedback" value="<?php echo $feedback; ?>"/></td>
        </tr>
    </table>
</form>


<?php
    }

else
    {
        echo "vous n'avez pas sélectionné de question";
    }

?>
