<?php
require "funnction.php";
include('header.php');

$user = $_SESSION['membre']["email"] ?? "";

$currentUsers =  getUrrentUser($user);

if (!$currentUsers) {
    header("location:index.php");
}


//afficher le nb d'abo
$getFollow = $pdo->query("SELECT COUNT(id_follow) FROM follow WHERE id_suivi = $currentUsers[id_membre]");
$follow = $getFollow -> fetch(PDO::FETCH_ASSOC);
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
        <li>Nombre d'abonnés : <?php echo implode($follow);?></li>
    </ul>
    <?php include("upload_img.php");?>
    <h3>Mes annonces:</h3>

<?php
$r = $pdo->query("SELECT * FROM post WHERE id_membre= $currentUsers[id_membre]");
while ($post = $r-> fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div style="margin-top: 20px; background: white; box-shadow: 0 5px 10px rgba(0, 0, 0, .09); padding: 5px 10px; border-radius: 10px">
    <div style="color: #666; text-decoration: none; font-size: 28px;"><?= $post['titre'] ?></div>
    <div style="border-top: 2px solid #EEE; padding: 15px 0"><?= nl2br($post['content_post']); ?></div>
    <a href="single-post.php?id_post=<?= $post['id_post'] ?>">Voir plus</a> </div>
<?php
}
?>

<!-- #################
a modifier en juste mes annonces 
################# -->
    <h3>mes annonces aimées: </h3>
<?php
    $r = $pdo->query("SELECT * FROM post WHERE id_post IN (SELECT id_post FROM reaction WHERE id_membre = $currentUsers[id_membre])");
while ($post = $r-> fetch(PDO::FETCH_ASSOC)){
    ?>
    <div style="margin-top: 20px; background: white; box-shadow: 0 5px 10px rgba(0, 0, 0, .09); padding: 5px 10px; border-radius: 10px">
    <div style="color: #666; text-decoration: none; font-size: 28px;"><?= $post['titre'] ?></div>
    <div style="border-top: 2px solid #EEE; padding: 15px 0"><?= nl2br($post['content_post']); ?></div>
    <a href="single-post.php?id_post=<?= $post['id_post'] ?>">Voir plus</a> </div>
<?php
}
?>
<h3>mes abonnements</h3>
<?php
//affiche les personnes que je suis
$get_mesfollows = $pdo->query("SELECT id_membre, pseudo, photo_profil FROM membre WHERE id_membre IN (SELECT id_suivi FROM follow WHERE id_suiveur = $currentUsers[id_membre])");
while ($mesfollows = $get_mesfollows-> fetch(PDO::FETCH_ASSOC)){?>
    <a href="voir_profil.php?id_membre=<?= $mesfollows['id_membre'] ?>"><?php echo $mesfollows['pseudo'];?></a>
    <img src="<?php echo $mesfollows['photo_profil'] ?>" alt="" width="200px">
    <?php
};
?>

<h3>mes followers</h3>
<?php
//affiche les personnes qui me suivent  
$get_suiveur = $pdo->query("SELECT id_membre, pseudo, photo_profil FROM membre WHERE id_membre IN (SELECT id_suiveur FROM follow WHERE id_suivi = $currentUsers[id_membre])");
while ($suiveur = $get_suiveur-> fetch(PDO::FETCH_ASSOC)){?>
    <a href="voir_profil.php?id_membre=<?= $suiveur['id_membre'] ?>"><?php echo $suiveur['pseudo'];?></a>
    <img src="<?php echo $suiveur['photo_profil'] ?>" alt="" width="200px">
    <?php
};
?>

</body>
</html>
