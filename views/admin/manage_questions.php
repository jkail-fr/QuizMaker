<?php
// connexion à la BDD
require_once('../../includes/sqlconnect.php');
?>

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
            $tableau = $bdd->query('SELECT * FROM `qanda` ORDER BY ID');
            while($donnees = $tableau->fetch())
                    {
        ?>

            <tr>
                <td><a href='#'> Modifier </a></td>
                <td><?php echo $donnees['question']; ?></td>
                <td>
                    <?php
                    //    $toto = json_decode($donnees['categorie']);
                    //    var_dump ($toto);
                    ?></td>
                <td><?php echo $donnees['niveau']; ?></td>
                <td><?php echo $donnees['bonne_reponse']; ?></td>
                <td><?php echo $donnees['facile']; ?></td>
                <td><?php echo $donnees['intermediaire']; ?></td>
                <td><?php echo $donnees['expert']; ?></td>
                <td><?php echo $donnees['feedback']; ?></td>
            </tr>

        <?php
            }
            $tableau->closeCursor ();
        ?>
    </tbody>
</table>
