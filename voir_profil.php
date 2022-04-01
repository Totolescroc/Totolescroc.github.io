<?php
require "funnction.php";
include('header.php');

$id = (int) $_GET['id_membre'];
$afficher_profil = $pdo->query("SELECT * 
FROM membre 
WHERE id_membre = $id",);
$afficher_profil = $afficher_profil->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Profil de <?= $afficher_profil['pseudo'] . " " . $afficher_profil['email']; ?></h2>
  <body>
</html>