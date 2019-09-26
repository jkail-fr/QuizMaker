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
        echo "categorie ajoutée";
    }


// affichage des categories
$reponse = $bdd->query('SELECT * FROM `categories` ORDER BY nom ASC');

?>

<!-- création d'une nouvelle catégorie -->
<h2>Ajouter une catégorie</h2>

<form action=# method="POST">
    Categorie : <input type="text" value= "" name = "categorie" placeholder="votre nouvelle catégorie"/>
    <button type="submit">Ajouter</button>
</form>
<hr>

<!-- modification des listes -->
<h2>Gérer les catégories</h2>

<select id='categorie'>
   <?php
    while($donnees = $reponse->fetch())
          {
            echo '<option value="'.$donnees['ID'].'">' . $donnees['nom'] . '</option>' ;
          }
    ?>
</select>

