<!-- Partie PHP -->
<?php

// connexion à la BDD
require_once('includes/sqlconnect.php');
?>

<!-- Partie HTML -->
<!DOCTYPE html>
<html>

    <!-- Header -->
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="./css/style.css" /> <!-- Renvoi sur la page style -->
        <title>Accueil - Quizz</title> <!-- Titre de la page -->
    </head>

    <!-- Body -->
    <body>

       <!-- Header du Body -->
       <header>
           <h1> Bienvenue sur la page d'accueil du quizz </h1>

           <!-- Paragraphe de présentation de la page -->
            <p>
                (phrase d'accueil : blablabla)
            </p>
       </header>

       <!-- Liste des catégories de quizz -->
       <div>
            Cliquez ici pour choisir la catégorie et le niveau du quizz :

            <hr>

            <form action='quizz.php' method="POST">

                <div id="listecat">
                    <input type="radio" name="cat" value="random" required>
                    <label for="cat">Quizz Aléatoire</label><br>
                    <?php
                        $reponse = $bdd->query('SELECT * FROM `categories` ORDER BY noms ASC');
                        while($donnees = $reponse->fetch())
                            {
                                echo '<input type="radio" id="'.$donnees['ID_Cat'].'" value="'.$donnees['ID_Cat'].'" name="cat" required>
                                    <label for="'.$donnees['ID_Cat'].'">'.$donnees['noms'].'</label> <br>';
                            }
                        $reponse->closeCursor ();
                    ?>
                </div>

                <hr>

                <div id="listeniv">
                    <?php
                        $reponse = $bdd->query('SELECT * FROM `niveaux` ORDER BY ID_Niv ASC');
                        while($donnees = $reponse->fetch())
                            {
                                echo '<input type="radio" id="'.$donnees['ID_Niv'].'" value="'.$donnees['ID_Niv'].'" name="niv" required>
                                    <label for="'.$donnees['ID_Niv'].'">'.$donnees['nom'].'</label> <br>';
                            }
                        $reponse->closeCursor ();
                    ?>
                </div>

                <hr>

                <button type="submit">Aller au quizz</button>

            </form>
       </div>

        <hr>

       <!-- Footer -->
       <footer>
           <div ><a href="./views/admin/index.html">administration</a></div>
       </footer>

    </body>
</html>
