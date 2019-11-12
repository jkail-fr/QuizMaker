<?php
// connexion à la BDD
require_once('../../includes/sqlconnect.php');
?>

<h1>Gestion des questions</h1>

<form action="edit_question.php" method="post">
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
                $tableau = $bdd->query('SELECT * FROM `qanda` ORDER BY ID');
                while($donnees = $tableau->fetch())
                        {
            ?>

                <tr>
                    <td>
                        <button type="submit" name="Modifier" value="<?php echo $donnees['ID']; ?>"> Modifier </button>
                    </td>

                    <td><?php echo $donnees['question']; ?></td>

                    <td><?php
                        $decodecat = json_decode($donnees['categorie']);
                        foreach ($decodecat as $element)
                        {
                            $nomcateg = $bdd->query('SELECT noms FROM `categories` WHERE ID_Cat = "'.$element.'"');
                            while($donneescat = $nomcateg->fetch())
                            {
                                echo $donneescat['noms'] . '<br />';
                            }
                        }
                        $nomcateg->closeCursor ();
                    ?> </td>

                    <td><?php
                        $decodeniv = json_decode($donnees['niveau']);
                        foreach ($decodeniv as $element)
                        {
                            $nomniv = $bdd->query('SELECT nom FROM `niveaux` WHERE ID_Niv = "'.$element.'"');
                            while($donneesniv = $nomniv->fetch())
                            {
                                echo $donneesniv['nom'] . '<br />';
                            }
                        }
                        $nomniv->closeCursor ();
                    ?></td>

                    <td><?php echo $donnees['bonne_reponse']; ?></td>

                    <td><?php echo $donnees['facile']; ?></td>

                    <td><?php echo $donnees['intermediaire']; ?></td>

                    <td><?php echo $donnees['expert']; ?></td>

                    <td><?php echo $donnees['feedback']; ?></td>

                    <td><a href='#'> Supprimer </a></td>
                </tr>

            <?php
                }
                $tableau->closeCursor ();
            ?>
        </tbody>
    </table>
</form>
