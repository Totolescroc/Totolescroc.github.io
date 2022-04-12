<link rel="stylesheet" href="style2.css">

<?php 
require "init.php";

// fonction de recuperation des données 
function getUrrentUser(string $mail){
    global $pdo;
    $currentUser = $pdo->query("SELECT * FROM membre WHERE email = '$mail'");
    $currentUser->execute();
    return $currentUser->fetch();
}

function getAllUser(string $mail){
global $pdo;
$allUser = $pdo->query("SELECT * FROM membre WHERE email != '$mail'");
$allUser->execute();
return $allUser->fetchall();
}

// recuperation de tout les postes
function getAllPosts(){
    global $pdo;
    $post = $pdo->query("SELECT * FROM membre");
    $post->execute();
    return $post->fetchAll();
}

// recuperation de d'un post par l'id du membre
function getOnePostByUserId($id){
    global $pdo;
    $post = $pdo->query("SELECT * FROM post WHERE id_membre = '$id'");
    $post->execute();
    return $post->fetch();
}
// fonction d'insertion des d'un post
// function insertPost(array $post){
//     global $pdo;
//     $pdo->exec("INSERT INTO post (titre, date_post, content_post, heure_post) 
//     VALUES ('$post[titre]',
//             '$post[date_post]',
//             '$post[description]',
//             '$post[heure_post]')
//             ");  
// }
?>