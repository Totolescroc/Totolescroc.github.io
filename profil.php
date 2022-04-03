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

</body>
</html>