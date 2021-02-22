<?php

require_once __DIR__ . "/../../security.php";
require_once __DIR__ . "/../../../model/database.php";

//Récupérer les données du formulaire
$label = $_POST["label"];
$id = $_POST["id"];

// Envoyer les données à la base de données
updateCategory($id, $label);

// Rediriger l'utilisateur
header("Location: index.php");

