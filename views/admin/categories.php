<h1>Gestion des catégories</h1>

<?php
// connexion à la BDD
require_once('../../includes/sqlconnect.php');


//récupération de la valeur categorie
if(isset($_POST['categorie']))
    {
        $newcat = $_POST['categorie'];
        $req = $bdd->prepare('INSERT INTO categories(nom) VALUES(:newcat)');
        $req-> execute(array(
        'newcat' => $newcat));
        $req->closeCursor ();
        echo "categorie ajoutée";
    }


//modification d'une categorie
if(isset($_POST['newcategorie']))
    if($_POST['cat'] != null)
    {
        $newname = $_POST['newcategorie'];
        $id = $_POST['cat'];
        $req = $bdd->prepare('UPDATE categories SET nom=:newname WHERE id=:id');
        $req-> execute(array(
        'newname' => $newname , 'id' => $id));
        $req->closeCursor ();
        echo "catégorie modifiée";
    }
    else
    {
        echo "catégorie inconnue";
    }


//suppression d'une categorie
if(isset($_POST['catfin']))
    if($_POST['catfin'] != null)
    {
        $id = $_POST['catfin'];
        $req = $bdd->prepare('DELETE FROM categories WHERE id=:id');
        $req-> execute(array('id' => $id));
        $req->closeCursor ();
        if($req)
            {
                 echo "categorie supprimée";
            }
    }
    else
    {
        echo "catégorie inconnue";
    }
?>


<!-- création d'une nouvelle catégorie -->
<h2>Ajouter une catégorie</h2>

<form action='#' method="POST">
    Categorie : <input type="text" value="" name="categorie" placeholder="votre nouvelle catégorie"/>
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
            $reponse = $bdd->query('SELECT * FROM `categories` ORDER BY nom ASC');
            while($donnees = $reponse->fetch())
                {
                    echo '<option value="'.$donnees['ID'].'">' . $donnees['nom'] . '</option>' ;
                }
            $reponse->closeCursor ();
            ?>
        </select>
    </div>

    <div id="modifiercategorie">
        <input type="text" value="" name="newcategorie" placeholder="renommer la catégorie"/>
        <button type="submit">Valider</button>
    </div>
</form>


<!-- supprimer une catégorie -->
<h3>Supprimer une catégoie</h3>
<form action='#' method="POST">
    <div id="categoriesfinales">
        <select id='catfin' name='catfin'>
           <option value="">---</option>
            <?php
            $reponse = $bdd->query('SELECT * FROM `categories` ORDER BY nom ASC');
            while($donnees = $reponse->fetch())
                {
                    echo '<option value="'.$donnees['ID'].'">' . $donnees['nom'] . '</option>' ;
                }
            $reponse->closeCursor ();
            ?>
        </select>
    </div>

    <div id="supprimercategorie">
        <button type="submit">Supprimer la catégorie</button>
    </div>
</form>
