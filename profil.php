<?php
require "funnction.php";

$user = $_SESSION['membre']["email"] ?? "";

$currentUsers =  getUrrentUser($user);

if (!$currentUsers) {
    header("location:accueil.php");
}


//afficher le nb d'abo
$getFollow = $pdo->query("SELECT COUNT(id_follow) FROM follow WHERE id_suivi = $currentUsers[id_membre]");
$follow = $getFollow -> fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Page Profil</title>
</head>
<body>
<?php include("upload_img.php");?>

    <div class="profil_image_pseudo">
        <img src="<?php echo $image['photo_profil'] ?>" alt="">
        <h2>Profil de <?php echo $currentUsers['pseudo'];?></h2>
    </div>

    <div>
        <ul>
            <li><p>Followers</p><p><?php echo implode($follow);?></p></li>
            <li>Annonces postées </li>
            <li>Follows</li>
        </ul>
    </div>
    <h2>Mes annonces:</h2>

<div class="card-annonce-container">    

<?php
$r = $pdo->query("SELECT * FROM post WHERE id_membre= $currentUsers[id_membre]");
while ($post = $r-> fetch(PDO::FETCH_ASSOC)) {
    ?>

<div class='card-annonce' id='card-annonce'>
    
    <div class="cat-auteur">
        <div class="card-cat">
            <?php
                $get_cat = $pdo ->query("SELECT name_cat FROM categorie WHERE id_cat = '$post[id_cat]'"); 
                $cat = $get_cat-> fetch(PDO::FETCH_ASSOC);

        echo $cat['name_cat']; ?>
        </div>
        <div class="auteur">
            <?php
                $get_pseudo = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$post[id_membre]'"); 
                $pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC);
            ?>
            <img src="<?php echo $pseudo['photo_profil'] ?>" alt="">

            Fait par  &nbsp <a href="voir_profil.php?id_membre=<?= $post['id_membre'] ?>"><?php echo $pseudo['pseudo'];?> </a>
        </div>
        
    </div>
    <div class='card-annonce-titre'>
        <?= $post['titre'] ?>
    </div>
    <div class="card-date-adresse">
    <div class="card-adresse">
        <?php echo $post['adresse'];?>   
    </div>
    <div class="card-date">
        <?php echo $post['date_post']?>
    </div>   
</div>
<a class="link-single-post" href="single-post.php?id_post=<?= $post['id_post'] ?>"></a>

<div><?= nl2br($post['content_post']); ?></div>
    <a href="single-post.php?id_post=<?= $post['id_post'] ?>">Voir plus</a> </div>
</div>
<?php
}
?>

<!-- #################
a modifier en juste mes annonces 
################# -->


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
