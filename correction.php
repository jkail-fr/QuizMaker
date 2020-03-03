<?php

session_start();

$currentQuizz = $_SESSION["repCorrectes"];
$reponseaffichage = $_SESSION["repUtilisateur"];

var_dump($currentQuizz);
var_dump($reponseaffichage);
