<h1>Gestion des catégories</h1>

<?php
// connexion à la BDD
require_once('../../includes/sqlconnect.php');


//Ajout d'une nouvelle categorie
if(isset($_POST['categorie']))
    {
        $newcat = $_POST['categorie'];
        $req = $bdd->prepare('INSERT INTO categories(noms) VALUES(:newcat)');
        $ex = $req-> execute(array('newcat' => $newcat));
        statutRequete($ex, "catégorie ajoutée", "échec de l'action");
        $req->closeCursor ();
    }


//modification d'une categorie
if(isset($_POST['newcategorie']))
    if($_POST['cat'] != null)
    {
        $newname = $_POST['newcategorie'];
        $id = $_POST['cat'];
        $req = $bdd->prepare('UPDATE categories SET noms=:newname WHERE ID_Cat=:id');
        $ex = $req-> execute(array('newname' => $newname , 'id' => $id));
        statutRequete($ex, "catégorie modifiée", "échec de l'action");
        $req->closeCursor ();
    }


//suppression d'une categorie
if(isset($_POST['catfin']))
    if($_POST['catfin'] != null)
    {
        $id = $_POST['catfin'];
        $req = $bdd->prepare('DELETE FROM categories WHERE ID_Cat=:id');
        $ex = $req-> execute(array('id' => $id));
        statutRequete($ex, "catégorie supprimée", "échec de l'action");
        $req->closeCursor ();
    }
?>


<!-- création d'une nouvelle catégorie -->
<h2>Ajouter une catégorie</h2>

<form action='#' method="POST">
    Categorie : <input type="text" value="" name="categorie" placeholder="votre nouvelle catégorie" required/>
    <button type="submit">Ajouter</button>
</form>
<hr>


<!-- modification des listes -->
<h2>Gérer les catégories</h2>


<!-- renommer une catégorie -->
<h3>Renommer une catégoie</h3>
<form action='#' method="POST">
    <div id="listecategories">
        <select id='categorie' name='cat'>
           <option value="">---</option>
            <?php
            $reponse = $bdd->query('SELECT * FROM `categories` ORDER BY noms ASC');
            while($donnees = $reponse->fetch())
                {
                    echo '<option value="'.$donnees['ID_Cat'].'">' . $donnees['noms'] . '</option>' ;
                }
            $reponse->closeCursor ();
            ?>
        </select>
    </div>

    <div id="modifiercategorie">
        <input type="text" value="" name="newcategorie" placeholder="renommer la catégorie" required/>
        <button type="submit">Valider</button>
    </div>
</form>


<!-- supprimer une catégorie -->
<h3>Supprimer une catégoie</h3>
<form action='#' method="POST" onsubmit="return confirm('Êtes-vous certain de vouloir supprimer cette catégorie ?');">
    <div id="categoriesfinales">
        <select id='catfin' name='catfin'>
           <option value="">---</option>
            <?php
            $reponse = $bdd->query('SELECT * FROM `categories` ORDER BY noms ASC');
            while($donnees = $reponse->fetch())
                {
                    echo '<option value="'.$donnees['ID_Cat'].'">' . $donnees['noms'] . '</option>' ;
                }
            $reponse->closeCursor ();
            ?>
        </select>
    </div>

    <div id="supprimercategorie">
        <button type="submit" >Supprimer la catégorie</button>
    </div>
</form>
