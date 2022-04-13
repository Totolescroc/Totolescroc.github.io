<?php
require "funnction.php";
include('menu-principal.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Home page</title>
</head>
<body>
    <?php
//   echo "<pre>";
//     print_r($_SESSION);
//   echo "</pre>";
$user = $_SESSION['membre']["email"] ?? "";
$currentUsers =  getUrrentUser($user);


    // var_dump($currentUser);
        if(isset($_SESSION['membre'])) {
        header('location:accueil.php');

    ?>
    	<!-- <a href="?action=deconnexion">Déconnexion</a>
		<br> -->
  
    
    <?php
        } else {
    ?>
    <div class="menu-connexion">

    <a href="inscription.php" class="button">inscription</a>

    <a href="mdp-oublie.php" class="button">mot de passe oublié</a>

    <a href="connexion.php" class="button">connexion</a>
    </div>
    <?php
       }
    ?>
    