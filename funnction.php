<?php 
require "init.php";

// fonction de recuperation des données 
function getUrrentUser(string $mail){
    global $pdo;
    $currentUser = $pdo->query("SELECT * FROM membre WHERE email = '$mail'");
    $currentUser->execute();
    return $currentUser->fetch();
}
function getUsers(string $mail){
    global $pdo; 
    $allUsers = $pdo->query("SELECT * FROM membre WHERE email != '$mail'");
    $allUsers->execute();
    return $allUsers->fetchall();
}

// recuperation de tout les postes
function getAllPosts(){
    global $pdo;
    $post = $pdo->query("SELECT * FROM membre");
    $post->execute();
    return $post->fetchAll();
}

// recuperation de d'un post par l'id du membre
function getOnePostByUserId(int $id){
    global $pdo;
    $post = $pdo->query("SELECT * FROM post WHERE id_membre = '$id'");
    $post->execute();
    return $post->fetch();
}
// fonction d'insertion des d'un post
function insertPost(array $post){
    global $pdo;
    $pdo->exec("INSERT INTO post (titre, date_post, content_post, heure_post) 
    VALUES ('$post[titre]',
            '$post[date_post]',
            '$post[description]',
            '$post[heure_post]')
            ");  
}
?>