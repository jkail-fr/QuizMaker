<?php

$host="localhost";

$dbname="quizmaker";

$user="root";

$password="root";

try
{
$bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
