<h1>Gestion des niveaux</h1>

<?php
// connexion à la BDD
require_once('../../includes/sqlconnect.php');


//Ajout d'un nouveau niveau
if(isset($_POST['level']))
    {
        $newlevel = $_POST['level'];
        $req = $bdd->prepare('INSERT INTO niveaux(nom) VALUES(:newlevel)');
        $ex = $req-> execute(array('newlevel' => $newlevel));
        statutRequete($ex, "niveau ajouté", "échec de l'action");
        $req->closeCursor ();
    }


//modification d'un niveau
if(isset($_POST['newniveau']))
    if($_POST['changelevel'] != null)
    {
        echo "toto";
        $newname = $_POST['newniveau'];
        $id = $_POST['changelevel'];
        $req = $bdd->prepare('UPDATE niveaux SET nom=:newname WHERE id=:id');
        $ex = $req-> execute(array('newname' => $newname , 'id' => $id));
        statutRequete($ex, "niveau modifié", "échec de l'action");
        $req->closeCursor ();
    }


//suppression d'un niveau
if(isset($_POST['levelfin']))
    if($_POST['levelfin'] != null)
    {
        $id = $_POST['levelfin'];
        $req = $bdd->prepare('DELETE FROM niveaux WHERE id=:id');
        $ex = $req-> execute(array('id' => $id));
        statutRequete($ex, "niveau supprimé", "échec de l'action");
        $req->closeCursor ();
    }
?>


<!-- création d'un nouveau niveau -->
<h2>Ajouter un niveau</h2>

<form action='#' method="POST">
    Niveau : <input type="text" value="" name="level" placeholder="votre nouveau niveau"/>
    <button type="submit">Ajouter</button>
</form>
<hr>


<!-- modification des listes -->
<h2>Gérer les niveaux</h2>


<!-- renommer un niveau -->
<h3>Renommer un niveau</h3>
<form action='#' method="POST">
    <div id="listeniveaux">
        <select id='niveau' name='changelevel'>
           <option value="">---</option>
            <?php
            $reponse = $bdd->query('SELECT * FROM `niveaux` ORDER BY nom ASC');
            while($donnees = $reponse->fetch())
                {
                    echo '<option value="'.$donnees['ID'].'">' . $donnees['nom'] . '</option>' ;
                }
            $reponse->closeCursor ();
            ?>
        </select>
    </div>

    <div id="modifiercategorie">
        <input type="text" value="" name="newniveau" placeholder="renommer le niveau"/>
        <button type="submit">Valider</button>
    </div>
</form>


<!-- supprimer une catégorie -->
<h3>Supprimer une catégoie</h3>
<form action='#' method="POST" onsubmit="return confirm('Êtes-vous certain de vouloir supprimer cette catégorie ?');">
    <div id="categoriesfinales">
        <select id='levelfin' name='levelfin'>
           <option value="">---</option>
            <?php
            $reponse = $bdd->query('SELECT * FROM `niveaux` ORDER BY nom ASC');
            while($donnees = $reponse->fetch())
                {
                    echo '<option value="'.$donnees['ID'].'">' . $donnees['nom'] . '</option>' ;
                }
            $reponse->closeCursor ();
            ?>
        </select>
    </div>

    <div id="supprimercategorie">
        <button type="submit" >Supprimer le niveau</button>
    </div>
</form>
