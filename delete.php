<?php

var_dump($_GET);

$id = $_GET["id"];

// 1. Connexion à la base de données SQL (PHPmyAdmin)
$pdo = new PDO("mysql:host=localhost;dbname=alimentation", "root", "", 
[
    // Retourne un tableau indéxé par les noms des colonnes 'fetch_assoc'
    // Tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

// Execute la requette
$delete = $pdo->prepare("DELETE FROM products WHERE id = ?");
$delete->execute([$id]);

// Renvoie sur la page d'origine
header("Location: index.php");