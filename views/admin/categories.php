<?php

echo "<h2>Gestion des catégories</h2>";

require_once('../../includes/sqlconnect.php');

try
{
$bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM `categories`');

$donnees = $reponse->fetch();
echo $donnees['nom'];

?>
