<?php
require "funnction.php";
include('header.php');

$user = $_SESSION['membre']["email"] ?? "";

$currentUsers =  getUrrentUser($user);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Profil</title>
</head>
<body>
    <h2>Voici le profil de <?= $currentUsers['pseudo']; ?></h2>
    <div>Quelques informations sur vous : </div>
    <ul>
        <li>Votre id est : <?= $currentUsers['id_membre'] ?></li>
        <li>Votre mail est : <?= $currentUsers['email'] ?></li>
    </ul>
</body>
</html>