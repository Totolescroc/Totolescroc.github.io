<?php

//je me co à la base de donnée

$pdo = new PDO('mysql:host=localhost;dbname=social-network', 'root', '', array(PDO::ATTR_ERRMODE =>
    PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//je vérifie:
//var_dump($pdo);

//j'ouvre une session temporaire:
session_start();

//s'il y a une action dans l'url et si cette action est = à deconnexion, alors je détruis la session:
if(isset($_GET['action'] && $_GET['action'] =='deconnexion')) {
    session_destroy();
    //je redirige vers l'acceuil
    header('location:index.php');
}

// je déclare une variable permettant d'afficher des messages pour l'utilisateur :
$content = "";

?>