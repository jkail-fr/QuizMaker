<?php
// connexion à la BDD
require_once('../../includes/sqlconnect.php');

// supression d'une question
if (isset($_POST['delete']))
    if ($_POST['delete'] != null) {
        $id = $_POST['delete'];
        $req = $bdd->prepare('DELETE FROM qanda WHERE ID=:id');
        $ex = $req->execute(array('id' => $id));
        statutRequete($ex, "question supprimée", "échec de l'action");
        $req->closeCursor();
    }
?>

<a href="index.html" class="retouracceuil"> Retour à l'accueil </a>

<h1>Gestion des questions</h1>


<table>
    <thead>
        <tr>
            <td>Action</td>
            <td>Questions</td>
            <td>Catégories</td>
            <td>Niveaux</td>
            <td>Bonne réponse</td>
            <td>Réponse facile</td>
            <td>Réponse intermédiaire</td>
            <td>Réponse Expert</td>
            <td>Feedback</td>
        </tr>
    </thead>

    <tbody>
        <?php
        // if (isset($_POST['recherche'])) {
        //     $mot = $_POST['recherche'];
        //     $tableau = $bdd->query("SELECT * FROM `qanda` WHERE CONCAT_WS(' ', question, bonne_reponse, facile, intermediaire, expert, feedback) LIKE '$mot' ORDER BY ID");
        //     var_dump($tableau);
        //     echo "toto";
        // } else {
        //     $tableau = $bdd->query('SELECT * FROM `qanda` ORDER BY ID');
        // }

        while ($donnees = $tableau->fetch()) {
        ?>

            <tr>
                <td>
                    <form action="edit_question.php" method="post" name="modifier">
                        <button type="submit" name="Modifier" value="<?php echo $donnees['ID']; ?>"> Modifier </button>
                    </form>
                </td>

                <td><?php echo $donnees['question']; ?></td>

                <td><?php
                    $decodecat = json_decode($donnees['categorie']);
                    foreach ($decodecat as $element) {
                        $nomcateg = $bdd->query('SELECT noms FROM `categories` WHERE ID_Cat = "' . $element . '"');
                        while ($donneescat = $nomcateg->fetch()) {
                            echo $donneescat['noms'] . '<br />';
                        }
                    }
                    $nomcateg->closeCursor();
                    ?> </td>

                <td><?php
                    $decodeniv = json_decode($donnees['niveau']);
                    foreach ($decodeniv as $element) {
                        $nomniv = $bdd->query('SELECT nom FROM `niveaux` WHERE ID_Niv = "' . $element . '"');
                        while ($donneesniv = $nomniv->fetch()) {
                            echo $donneesniv['nom'] . '<br />';
                        }
                    }
                    $nomniv->closeCursor();
                    ?></td>

                <td><?php echo $donnees['bonne_reponse']; ?></td>

                <td><?php echo $donnees['facile']; ?></td>

                <td><?php echo $donnees['intermediaire']; ?></td>

                <td><?php echo $donnees['expert']; ?></td>

                <td><?php echo $donnees['feedback']; ?></td>

                <td>
                    <form action='#' method="POST" onsubmit="return confirm('Êtes-vous certain de vouloir supprimer cette question ?');" name="supprimer">
                        <div id="supprimerquestion">
                            <button type="submit" name="delete" value="<?php echo $donnees['ID']; ?>">Supprimer</button>
                        </div>
                    </form>
                </td>

            </tr>

        <?php
        }
        $tableau->closeCursor();
        ?>
    </tbody>
</table>
